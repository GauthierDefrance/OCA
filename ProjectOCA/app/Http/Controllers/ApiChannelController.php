<?php

namespace App\Http\Controllers;

use App\Events\GroupAccessUpdated;
use App\Events\InvitationEvent;
use App\Events\MessageSent;
use App\Models\Conversation;
use App\Models\Invitation;
use App\Models\Message;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiChannelController extends Controller
{

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllMessages($id): \Illuminate\Http\JsonResponse
    {
        $messages = Message::where('conversation_id', $id)
            ->with('sender:id,name,email')  // Charge la relation "sender" avec les champs demandés
            ->orderBy('created_at')
            ->get()
            ->map(function ($message) {
                return [
                    'id' => $message->id,
                    'content' => $message->body,
                    'created_at' => $message->created_at->toDateTimeString(),
                    'type' => $message->type,
                    'sender' => $message->sender ? [
                        'id' => $message->sender->id,
                        'name' => $message->sender->name,
                        'email' => $message->sender->email,
                    ] : null,
                ];
            });
        return response()->json([
            'success' => true,
            'messages' => $messages,
        ]);
    }

    public function getNewMessages(Request $request, $id)
    {

        $validated = $request->validate([
            'since' => 'nullable|date',
        ]);
        $since = $validated['since'] ?? null;

        $conversation = Conversation::findOrFail($id);

        $query = Message::where('conversation_id', $conversation->id);


        if ($since) {
            $query->where('created_at', '>', $since);
        }

        $newMessages = $query->with('sender')->orderBy('created_at', 'asc')->get();

        return response()->json([
            'success' => true,
            'new_messages' => $newMessages->map(function ($message) {
                return [
                    'id' => $message->id,
                    'content' => $message->body,
                    'created_at' => $message->created_at->toDateTimeString(),
                    'type' => $message->type,
                    'sender' => $message->sender ? [
                        'id' => $message->sender->id,
                        'name' => $message->sender->name,
                        'email' => $message->sender->email,
                    ] : null,
                ];
            }),

        ]);
    }



    public function getMembers($id)
    {
        // Récupérer la conversation avec ses utilisateurs
        $conversation = Conversation::with('users')->findOrFail($id);

        // Retourner les utilisateurs uniquement (pas le pivot)
        $members = $conversation->sender->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,  // adapter selon les colonnes de ta table users
                'email' => $user->email, // si tu veux
                // ajouter d’autres champs utiles ici
            ];
        });

        return response()->json([
            'success' => true,
            'members' => $members,
        ]);
    }

    public function sendMessage(Request $request, $id)
    {
        // Valider les données JSON envoyées
        $validated = $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        // Trouver la conversation (middleware auth.channel doit déjà sécuriser l'accès)
        $conversation = Conversation::findOrFail($id);

        if (!$conversation->users()->where('user_id', auth()->id())->exists()) {
            return response()->json(['error' => 'Access denied'], 403);
        }

        // Créer le message
        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => auth()->id(),
            'type' => "user",
            'body' => $validated['message'],
        ]);

        broadcast(new MessageSent($message, $message->conversation_id));

        // Retourner une réponse JSON
        return response()->json([
            'success' => true,
        ], 201);
    }

    public function deleteMessage($id){

    }

    public function quitConfirmChannel(Request $request, $id)
    {
        $conversation = Conversation::findOrFail($id);
        $user = Auth::user();

        // Ajoute un message système avant de le retirer
        $systemMessage = $user->name . ' a quitté la conversation.';
        $message = $conversation->messages()->create([
            'sender_id' => null,
            'body' => $systemMessage,
            'type' => 'system',
        ]);

        // Détache l'utilisateur de la conversation
        $conversation->users()->detach($user->id);

        // Si plus aucun utilisateur n'est dans la conversation, la supprimer
        if ($conversation->users()->count() === 0) {
            $conversation->delete();
            return redirect()->route('channels.index')->with('success', 'Vous avez quitté et supprimé la conversation (elle n’avait plus de membres).');
        }

        broadcast(new MessageSent($message, $message->conversation_id));

        return redirect()->route('channels.index')->with('success', 'Vous avez quitté la conversation.');
    }

    private function delete_group($id)
    {
        $conversation = Conversation::findOrFail($id);
        $conversation->delete();
    }

    public function sendInvite(Request $request, $id)
    {
        $request->validate([
            'recipient_email' => ['required', 'email'],
        ]);

        $conversation = Conversation::findOrFail($id);

        $recipient = User::where('email', $request->input('recipient_email'))->first();

        if ($recipient->hasBlocked(auth()->user())) {
            return redirect()->back()->withErrors(['recipient_email' => 'Vous ne pouvez pas inviter cet utilisateur.']);
        }

        if (!$recipient) {
            return redirect()->back()->withErrors(['recipient_email' => 'Utilisateur introuvable.']);
        }

        // Vérifier s'il n'est pas déjà membre de la conversation
        if ($conversation->users()->where('user_id', $recipient->id)->exists()) {
            return redirect()->back()->withErrors(['recipient_email' => 'Cet utilisateur est déjà membre du groupe.']);
        }

        // Vérifier si une invitation existe déjà et est toujours "pending"
        $existingInvitation = Invitation::where('conversation_id', $conversation->id)
            ->where('recipient_id', $recipient->id)
            ->first();

        if ($existingInvitation) {
            return redirect()->back()->withErrors(['recipient_email' => 'Une invitation est déjà en attente pour cet utilisateur.']);
        }

        // Créer une nouvelle invitation
        $invitation = Invitation::create([
            'conversation_id' => $conversation->id,
            'sender_id' => auth()->id(),
            'recipient_id' => $recipient->id,
        ]);

        // Créer un message système indiquant l'invitation
        $inviterName = auth()->user()->name ?? 'Un utilisateur';
        $recipientName = $recipient->name ?? $recipient->email;

        $systemMessage = "{$inviterName} a invité {$recipientName} dans le groupe le " . Carbon::now()->format('d/m/Y H:i');

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => null, // message système
            'body' => $systemMessage,
            'type' => 'system',
        ]);

        broadcast(new MessageSent($message, $message->conversation_id));
        broadcast(new InvitationEvent($invitation));

        return redirect()->back()->with('success', 'Invitation envoyée avec succès.');
    }


    public function acceptInvitation(Request $request, $id)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'Utilisateur non authentifié.'], 401);
        }

        $senderId = (int) $request->input('sender_id');
        $recipientId = (int) $request->input('recipient_id');
        $conversationId = (int) $id;

        $invitation = Invitation::where('conversation_id', $conversationId)
            ->where('sender_id', $senderId)
            ->where('recipient_id', $recipientId)
            ->first();

        if (!$invitation) {
            return response()->json(['message' => 'Invitation introuvable.'], 404);
        }

        if ($recipientId != $user->id) {
            return response()->json(['message' => 'Permission refusée.'], 403);
        }

        $conversation = Conversation::find($id);
        if (!$conversation) {
            return response()->json(['message' => 'Conversation introuvable.'], 404);
        }

        $wasNewMember = false;

        // Ajoute l'utilisateur à la conversation s’il n’y est pas déjà
        if (!$conversation->users()->where('user_id', $user->id)->exists()) {
            $conversation->users()->attach($user->id);
            $wasNewMember = true;
        }

        // Supprime l'invitation après l'acceptation
        $invitation->delete();

        // Si l'utilisateur était bien un nouveau membre, on envoie un message système
        if ($wasNewMember) {
            $systemMessage = $user->name . ' a rejoint la conversation.';
            $message = $conversation->messages()->create([
                'sender_id' => null,
                'body' => $systemMessage,
                'type' => 'system',
            ]);
        }

        broadcast(new MessageSent($message, $message->conversation_id));
        broadcast(new GroupAccessUpdated('added', $conversation, $user->id));

        return response()->json(['message' => 'Invitation acceptée avec succès.']);
    }

    public function rejectInvitation(Request $request, $id)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'Utilisateur non authentifié.'], 401);
        }

        $senderId = $request->input('sender_id');
        $recipientId = $request->input('recipient_id');

        $invitation = Invitation::where('conversation_id', $id)
            ->where('sender_id', $senderId)
            ->where('recipient_id', $recipientId)
            ->first();

        if (!$invitation) {
            return response()->json(['message' => 'Invitation introuvable.'], 403);
        }

        if ($recipientId != $user->id) {
            return response()->json(['message' => 'Permission refusée.'], 403);
        }

        // Supprime simplement l'invitation pour la refuser
        $invitation->delete();

        return response()->json(['message' => 'Invitation refusée avec succès.']);
    }





}
