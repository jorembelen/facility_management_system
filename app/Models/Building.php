<?php

namespace App\Models;

use App\Traits\TenantTrait;
use App\Models\FacilityType;
use App\Traits\BuildingTrait;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Building extends Model
{
    use HasFactory, TenantTrait, BuildingTrait;

    public $incrementing = false;

    protected $fillable = [
                'user_id',
                'tenant_id',
                'rc_no',
                'ifc_no',
                'flat_no',
                'villa_no',
                'lot_no',
                'block_no',
                'street',
                'facility_type_id',
                'status',
                'upgraded',
    ];

    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }

    public function restoration()
    {
        return $this->hasMany(BuildingRestoration::class);
    }

    public function checkout()
    {
        return $this->hasOne(Checkout::class, 'building_id');
    }

    public function jobOrder()
    {
        return $this->hasMany(JobOrder::class);
    }

    public function checkouts()
    {
        return $this->hasMany(Checkout::class, 'building_id');
    }

    public function occupancy()
    {
        return $this->hasOne(Occupancy::class, 'building_id');
    }

    public function appointments()
    {
        return $this->hasMany(ClientAppointment::class, 'building_id');
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'buildings', 'length' => 7, 'prefix' =>'SDR']);
        });
    }

    public function type()
    {
        return $this->belongsTo(FacilityType::class, 'facility_type_id');
    }

    public static function search($search)
    {
        return empty($search) ? static::query()
        : static::query()
            ->whereHas('type', function($t) use($search) {
                $t->where('name', 'like', '%'.$search.'%');
            })
            ->orWhere('id', 'like', '%'.$search.'%')
            ->orWhere('street', 'like', '%'.$search.'%');
    }

}
