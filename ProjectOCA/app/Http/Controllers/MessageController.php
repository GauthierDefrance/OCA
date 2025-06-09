<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Conversation;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Fonction qui permet l'envoi d'un message accompagné d'un broadcast à tout les utilisateurs écoutant.
     * @param Request $request
     * @param $conversationId
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessage(Request $request, $conversationId)
    {
        $request->validate([
            'message' => 'required|string|max:5000',
        ]);

        $conversation = Conversation::findOrFail($conversationId);

        $message = $conversation->messages()->create([
            'sender_id' => Auth::id(),
            'body' => $request->message,
            'type' => 'user',
        ]);



        return response()->json(['message' => $message]);
    }

}
