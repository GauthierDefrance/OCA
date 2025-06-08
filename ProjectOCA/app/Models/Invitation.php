<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'recipient_id',
        'conversation_id',
    ];

    /**
     * Utilisateur qui envoie l'invitation.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Utilisateur qui reçoit l'invitation.
     */
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    /**
     * La conversation liée à l'invitation.
     */
    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
}
