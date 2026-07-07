<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'balance_before',
        'balance_after',
        'related_id',
        'related_type',
        'transaction_id',
        'meta',
        'status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'balance_before' => 'decimal:2',
        'balance_after' => 'decimal:2',
        'meta' => 'array',
    ];

    public static function generateTransactionId(): string
    {
        do {
            $id = 'TXN-' . strtoupper(Str::random(10));
        } while (self::where('transaction_id', $id)->exists());

        return $id;
    }
}
