<?php

namespace App\Http\Controllers;

use App\Models\conversation;
use App\Models\Invitation;
use App\Models\Message;
use Illuminate\Foundation\Auth\User;
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
                    'created_at' => $message->created_at->toDateTimeString(), // format plus lisible
                    'sender' => [
                        'id' => $message->sender->id,
                        'name' => $message->sender->name,
                        'email' => $message->sender->email,
                    ],
                    // ajoute d'autres champs si nécessaire, par ex :
                    // 'is_read' => $message->is_read,
                    // 'attachments' => $message->attachments,
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
                    'created_at' => $message->created_at->toDateTimeString(), // format plus lisible
                    'sender' => [
                        'id' => $message->sender->id,
                        'name' => $message->sender->name,
                        'email' => $message->sender->email,
                    ],
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
        ], [], [], $request->json()->all());

        // Trouver la conversation (middleware auth.channel doit déjà sécuriser l'accès)
        $conversation = Conversation::findOrFail($id);

        // Créer le message
        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => auth()->id(),
            'body' => $validated['message'],
        ]);

        // Retourner une réponse JSON
        return response()->json([
            'success' => true,
            'message' => 'Message envoyé avec succès',
            'data' => $message,
        ], 201);
    }

    public function deleteMessage($id){

    }

    public function quitConfirmChannel(Request $request, $id)
    {
        $conversation = Conversation::findOrFail($id);
        $user = Auth::user();

        // Détache l'utilisateur de la conversation (sans supprimer les messages)
        $conversation->users()->detach($user->id);



        // Redirection (ajuste selon ton application)
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
        Invitation::create([
            'conversation_id' => $conversation->id,
            'sender_id' => auth()->id(),
            'recipient_id' => $recipient->id,
        ]);

        return redirect()->back()->with('success', 'Invitation envoyée avec succès.');
    }


    public function acceptInvitation(Request $request, $id)
    {
        $senderId = $request->input('sender_id');
        $recipientId = $request->input('recipient_id');

        $invitation = Invitation::where('conversation_id', $id)
            ->where('sender_id', $senderId)
            ->where('recipient_id', $recipientId)
            ->first();

        if (!$invitation) {
            return response()->json(['message' => 'Invitation introuvable.'], 404);
        }

        $user = auth()->user();

        $conversation = Conversation::findOrFail($id);
        if (!$conversation->users->contains($user->id)) {
            $conversation->users()->attach($user->id);
        }

        $invitation->delete();

        return response()->json(['message' => 'Invitation acceptée avec succès.']);
    }


}
