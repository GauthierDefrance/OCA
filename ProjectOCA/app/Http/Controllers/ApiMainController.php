<?php

namespace App\Http\Controllers;

use App\Events\GroupAccessUpdated;
use App\Events\MessageSent;
use App\Models\Block;
use App\Models\Conversation;
use App\Models\Message;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiMainController extends Controller
{

    /**
     * Method that return the list of all the groups that the user is part in.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGroupList() {
        $user = Auth::user();

        // On récupère les conversations liées à l'utilisateur avec leurs infos principales
        $conversations = $user->conversations()
            ->select('conversations.id', 'conversations.title', 'conversations.description')
            ->get();

        return response()->json([
            'success' => true,
            'groups' => $conversations,
        ]);
    }

    public function getBlockList(Request $request) {

    }

    public function getInviteList(Request $request) {

    }

    /**
     * Method that allows the creation of a group
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */

    public function createGroup(Request $request) {
        // 1. Valider la requête
        $validated = $request->validate([
            'title' => 'required|string|max:64',
            'description' => 'nullable|string',
            'redirect_after' => 'required|boolean',
        ]);

        // 2. Créer la conversation
        $conversation = Conversation::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
        ]);

        // 3. Ajouter l'utilisateur connecté dans la table pivot avec isModerator = true
        $conversation->users()->attach(Auth::id(), ['isModerator' => true]);

        // 4. Créer un message système indiquant la création du groupe
        $userName = Auth::user()->name ?? 'Un utilisateur';
        $systemMessage = "{$userName} a créé le groupe le " . Carbon::now()->format('d/m/Y H:i');

        $conversation->messages()->create([
            'sender_id' => null,
            'body' => $systemMessage,
            'type' => 'system',
        ]);

        if (!$validated['redirect_after']) {
            return response()->json([
                'success' => true,
                'message' => 'Group created successfully',
                'group' => $conversation,
            ], 201);
        }
        return redirect()->back();
    }



    public function blockUser(Request $request)
    {
        $validated = $request->validate([
            'email_to_block' => 'required|string|email|max:255',
        ]);

        $email = $validated['email_to_block'];

        $userToBlock = User::where('email', $email)->first();

        if (!$userToBlock) {
            return response()->json(['message' => 'Utilisateur introuvable.'], 404);
        }

        $currentUser = auth()->user();

        // Vérifie si l'utilisateur essaie de se bloquer lui-même
        if ($currentUser->id === $userToBlock->id) {
            return response()->json(['message' => 'Vous ne pouvez pas vous bloquer vous-même.'], 400);
        }

        // Vérifie si le blocage existe déjà
        $alreadyBlocked = Block::where('blocker_id', $currentUser->id)
            ->where('blocked_id', $userToBlock->id)
            ->exists();

        if ($alreadyBlocked) {
            return response()->json(['message' => 'Utilisateur déjà bloqué.'], 409);
        }

        // Crée le blocage
        Block::create([
            'blocker_id' => $currentUser->id,
            'blocked_id' => $userToBlock->id,
        ]);

        return response()->json([
            'message' => 'Utilisateur bloqué avec succès.',
            'user' => [
                'id' => $userToBlock->id,
                'name' => $userToBlock->name,
                'email' => $userToBlock->email,
            ]
        ]);
    }


    public function unblockUser(Request $request)
    {

        $validated = $request->validate([
            'user_id' => 'required|string|exists:users,id',
        ]);

        $id = $validated['user_id'];

        $blocker = auth()->user(); // Utilisateur connecté

        if ($blocker->id == $id) {
            return response()->json(['message' => 'Action non autorisée.'], 400);
        }

        $blocked = User::find($id);

        if (!$blocked) {
            return response()->json(['message' => 'Utilisateur introuvable.'], 404);
        }

        // Vérifie s'il y a bien un blocage existant
        $block = Block::where('blocker_id', $blocker->id)
            ->where('blocked_id', $blocked->id)
            ->first();

        if (!$block) {
            return response()->json(['message' => 'Cet utilisateur n’est pas bloqué.'], 404);
        }

        $block->delete();

        return response()->json(['message' => 'Utilisateur débloqué avec succès.']);
    }


    public function kickUser(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|integer|exists:conversations,id',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $conversation = Conversation::findOrFail($request->conversation_id);
        $userToKick = User::findOrFail($request->user_id);

        // Vérifie si l'utilisateur fait bien partie de la conversation
        if (!$conversation->users->contains($userToKick->id)) {
            return response()->json(['message' => 'Utilisateur non membre du groupe.'], 400);
        }

        // Supprime le lien entre l'utilisateur et la conversation
        $conversation->users()->detach($userToKick->id);

        // Message système
        $kickerName = auth()->user()->name;
        $kickedName = $userToKick->name;

        $systemMessage = "{$kickerName} a exclu {$kickedName} du groupe le " . Carbon::now()->format('d/m/Y H:i');

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => null, // message système
            'body' => $systemMessage,
            'type' => 'system',
        ]);

        // Diffusion de l’événement via websocket
        broadcast(new MessageSent($message, $conversation->id));
        broadcast(new GroupAccessUpdated('removed', $conversation, $userToKick->id));

        return response()->json(['message' => 'Utilisateur exclu avec succès.']);
    }


}
