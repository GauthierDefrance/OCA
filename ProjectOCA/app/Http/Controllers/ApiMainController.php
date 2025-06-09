<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Carbon\Carbon;
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




}
