<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserChatView extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'chat_id',
        'appointment_id',
        'read_at',
    ];

}
