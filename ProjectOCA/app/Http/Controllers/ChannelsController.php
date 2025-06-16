<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Invitation;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class ChannelsController extends Controller
{
    public function index() {
        $user = auth()->user();

        // Conversations (groupes) de l'utilisateur
        $groups = $user->conversations()->get();

        // Invitations reçues par l'utilisateur (non acceptées, si tu as un status, sinon toutes)
        $invitations = \App\Models\Invitation::where('recipient_id', $user->id)->get();

        $blockedUsers = $user->blockedUsers()->get();

        return view('pages.channels.index', compact('groups', 'invitations', 'blockedUsers'));
    }
    public function showQuitChannel($id) {
        $conversation = Conversation::findOrFail($id); // Récupère la conversation ou échoue si non trouvée
        return view('pages.channels.quit', [
            'id' => $id,
            'name' => $conversation->title, // Passe le nom du groupe à la vue
        ]);
    }

    public function showGroupMember($id)
    {
        $conversation = Conversation::with('users')->findOrFail($id);
        $members = $conversation->users;
        $conversationName = $conversation->title;
        $conversationId = $conversation->id;
        $conversationDescription = $conversation->description;

        // Vérifie si l'utilisateur connecté est modérateur du groupe
        $currentUser = auth()->user();
        $isModerator = $conversation->users()
            ->where('user_id', $currentUser->id)
            ->first()
            ?->pivot
            ?->isModerator ?? false;

        return view('pages.channels.members', compact('members', 'conversationName', 'conversationId', 'conversationDescription', 'isModerator'));
    }

    public function showAddMember($id)
    {
        $conversation = Conversation::findOrFail($id);

        $existingUserIds = $conversation->users()->pluck('users.id')->toArray();

        $usersToInvite = User::whereNotIn('id', $existingUserIds)->get();

        // Récupérer les invitations déjà envoyées pour cette conversation
        $invitations = Invitation::where('conversation_id', $conversation->id)->get();

        return view('pages.channels.add', [
            'conversation' => $conversation,
            'usersToInvite' => $usersToInvite,
            'invitations' => $invitations,
        ]);
    }




}
