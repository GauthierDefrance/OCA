<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HasAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $conversationId = $request->route('id'); // récupère l'id du salon depuis la route

        if (!$user) {
            // Pas connecté
            abort(401, 'Non authentifié');
        }

        // Vérifie que l'utilisateur appartient à la conversation
        $hasAccess = $user->conversations()->where('conversations.id', $conversationId)->exists();

        if (!$hasAccess) {
            abort(403, 'Accès refusé au salon');
        }

        return $next($request);
    }
}
