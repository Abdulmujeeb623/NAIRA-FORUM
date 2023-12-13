<?php
// app/Models/SocialAccount.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    use HasFactory;

    protected $fillable = ['social_id', 'social_type', 'user_id'];

    /**
     * Get the user that owns the social account.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
