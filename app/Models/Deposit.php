<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $fillable = [
        'user_id',
        'txid',
        'status',
        'amount',
        'method',
        'proof_image', // Ensure this matches the database column exactly
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}