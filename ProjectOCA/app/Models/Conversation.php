<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'conversation_user')
            ->using(ConversationUser::class)
            ->withPivot('isModerator')
            ->withTimestamps();
    }

    public function conversationUsers(): HasMany
    {
        return $this->hasMany(ConversationUser::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }


}
