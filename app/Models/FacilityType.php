<?php

namespace App\Models;

use App\Models\Building;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FacilityType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function building()
    {
        return $this->hasMany(Building::class);
    }
}
