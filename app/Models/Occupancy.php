<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Occupancy extends Model
{
    use HasFactory;

    protected $dates = [
        'checkin_date'
    ];

    protected $fillable = [
        'tenant_id',
        'building_id',
        'checkin_date',
        'checkedinBy',
        'assigned_date',
        'assignedBy',
        'remarks',
        'status',
        'assign_attachment',
        'checkin_attachment',
    ];

    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id', 'badge');
    }

    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id');
    }



}
