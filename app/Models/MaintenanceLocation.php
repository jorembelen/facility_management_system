<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_category_id',
        'location',
    ];

}
