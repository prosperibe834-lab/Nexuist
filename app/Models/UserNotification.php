<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'message',
        'status',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function createForUser($user, $type, $message, $meta = null)
    {
        return self::create([
            'user_id' => $user->id,
            'type' => $type,
            'message' => $message,
            'status' => 'unread',
            'meta' => $meta,
        ]);
    }
}
