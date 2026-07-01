<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable = [
        'user_id',
        'transaction_id',
        'amount',
        'method',
        'source_wallet',
        'wallet_address',
        'status',
        'admin_notes',
        'approved_at',
        'rejected_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Generate unique transaction ID
    public static function generateTransactionId()
    {
        do {
            $random = strtoupper('NEXU-WIT-' . substr(bin2hex(random_bytes(4)), 0, 8));
        } while (self::where('transaction_id', $random)->exists());

        return $random;
    }
}
