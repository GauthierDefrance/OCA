<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('channels.{channelId}', function ($user, $channelId) {
    // Vérifie si l'utilisateur est connecté
    if (!$user) {
        return false;
    }
    // Vérifie que l'utilisateur appartient à la conversation
    return $user->conversations()->where('conversations.id', $channelId)->exists();
});

Broadcast::channel('invite.{userId}', function ($user, $userId) {
    // Vérifie si l'utilisateur est connecté
    if (!$user) {
        return false;
    }
    return true;
});



Broadcast::channel('channel-updater.{userId}', function ($user, $userId) {
    // Vérifie si l'utilisateur est connecté
    if (!$user) {
        return false;
    }
    return true;
});
