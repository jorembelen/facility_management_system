<?php

namespace App\Models;

use App\Traits\AppointmentTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Model;

class ClientAppointment extends Model
{
    use HasFactory, AppointmentTrait;

    public $incrementing = false;
    protected $dates = ['date'];

    protected $fillable = [
        'id',
        'user_id',
        'building_id',
        'scheduler_id',
        'work_category_id',
        'job_description',
        'schedule_time',
        'job_description',
        'job_location',
        'images',
        'date',
        'documents',
        'cancellation_comments',
        'emergency_type',
    ];

    public function category()
    {
        return $this->belongsTo(WorkCategory::class, 'work_category_id');
    }
    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function occupancy()
    {
        return $this->belongsTo(Occupancy::class, 'occupant_id');
    }

    public function jobOrder()
    {
        return $this->hasMany(JobOrder::class);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'client_appointments', 'length' => 11, 'prefix' =>'SAW-']);
        });
    }

}
