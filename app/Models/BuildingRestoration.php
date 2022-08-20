<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingRestoration extends Model
{
    use HasFactory;


    protected $fillable = [
        'building_id',
        'availability_date',
        'notes',
        'update_count',
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

}
