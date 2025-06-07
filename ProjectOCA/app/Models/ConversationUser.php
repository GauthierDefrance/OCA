<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ConversationUser extends Pivot
{
    protected $table = 'conversation_user';

    protected $fillable = [
        'conversation_id',
        'user_id',
        'isModerator',
    ];

    protected $casts = [
        'isModerator' => 'boolean',
    ];

    // Si tu veux désactiver les timestamps (mais ici tu en as, donc non)
    // public $timestamps = false;
}
