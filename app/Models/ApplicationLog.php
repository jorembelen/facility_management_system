<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationLog extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $fillable = [
        'log_info',
    ];

}
