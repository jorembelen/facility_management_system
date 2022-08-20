<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class JobOrder extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $dates = ['date'];

    protected $fillable = [
        'user_id',
        'client_appointment_id',
        'occupant_id',
        'building_id',
        'job_type',
        'technicians',
        'job_category',
        'notes',
        'status',
        'date',
        'time',
    ];

    // public static function boot()
    // {
    //     parent::boot();
    //     self::creating(function ($model) {
    //         $model->id = IdGenerator::generate(['table' => 'job_orders', 'length' => 8, 'prefix' =>'SDR-']);
    //     });
    // }

    public function occupant()
    {
        return $this->belongsTo(Occupant::class);
    }
    public function clientAppointment()
    {
        return $this->belongsTo(ClientAppointment::class);
    }
    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }

    public function technicians()
    {
        return $this->belongsToMany(JobOrderTechnician::class, 'job_order_id', 'employee_id');
    }

}
