<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class KycVerification extends Model
{
 protected $fillable = [
    'user_id',
    'first_name',
    'last_name',
    'email',
    'phone',
    'address',
    'city',
    'state',
    'document_type',
    'front_image',
    'back_image',
    'status',
];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}