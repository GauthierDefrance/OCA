<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name', 'email', 'password',
        // autres champs si besoin
    ];

    /**
     * 🔁 L'utilisateur participe à plusieurs conversations (many-to-many)
     */
    public function conversations()
    {
        return $this->belongsToMany(Conversation::class, 'conversation_user')
            ->using(ConversationUser::class)
            ->withPivot('isModerator')
            ->withTimestamps();
    }


    /**
     * 📤 L'utilisateur a envoyé plusieurs messages
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * 🧩 Accès direct à la table pivot (facultatif, mais utile pour certaines requêtes)
     */
    public function conversationLinks(): HasMany
    {
        return $this->hasMany(ConversationUser::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function emailVerifications(): HasMany
    {
        return $this->hasMany(EmailVerification::class);
    }

    // Les utilisateurs que je bloque
    public function blockedUsers()
    {
        return $this->belongsToMany(User::class, 'blocks', 'blocker_id', 'blocked_id');
    }

// Les utilisateurs qui m'ont bloqué
    public function blockedByUsers()
    {
        return $this->hasMany(Block::class, 'blocked_id');
    }

// Vérifier si un utilisateur est bloqué
    public function hasBlocked(User $user)
    {
        return $this->blockedUsers()->where('blocked_id', $user->id)->exists();
    }

// Vérifier si je suis bloqué par un autre utilisateur
    public function isBlockedBy(User $user)
    {
        return $this->blockedByUsers()->where('blocker_id', $user->id)->exists();
    }

    public function usersWhoBlockedMe()
    {
        return $this->belongsToMany(User::class, 'blocks', 'blocked_id', 'blocker_id');
    }





}
