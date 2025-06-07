<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'verification_code',
        'expires_at',
    ];

    protected $dates = ['expires_at'];

    // Relation avec User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
