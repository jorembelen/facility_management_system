<?php

namespace App\Models;

use App\Traits\TenantTrait;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable, TenantTrait;


    protected $primaryKey = 'badge';
    public $incrementing = false;
    // protected $keyType = 'string';

    protected $rules = [
        'email' => 'required|email|unique:users',
        'badge' => 'required|badge|unique:users',
        'username' => 'required|username|unique:users',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'mobile',
        'badge',
        'role',
        'email',
        'password',
        'status',
        'is_tenant',
        'upgraded',
        'reset',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getAvatar() {

        if($this->profile_photo_path == null){
            return Storage::disk('s3')->url('uploads/avatar/' .substr($this->name, 0, 1) . '.png');
        }else{
            return Storage::disk('s3')->url('uploads/thumbnails/' .$this->profile_photo_path);
        }

    }


    public function occupancy()
    {
        return $this->hasOne(Occupancy::class, 'tenant_id', 'badge');
    }

    public function checkout()
    {
        return $this->hasOne(Checkout::class, 'tenant_id');
    }

    public function building()
    {
        return $this->hasOne(Building::class, 'tenant_id', 'badge');
    }

    public function chat()
    {
        return $this->hasMany(Chat::class, 'user_id', 'badge');
    }

    public function appointment()
    {
        return $this->hasMany(ClientAppointment::class, 'user_id', 'badge');
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            if($model->badge == '') {
                $model->badge = (string) rand(1,1000000);
            }
        });
        User::creating(function ($model) {
            $model->setId();
        });
    }

    public function setId()
    {
        $this->attributes['id'] = Str::uuid();
    }

    public function userGreetings()
    {
        $greetings = "";
        $hour = date('H');
        if ($hour >= 18) {
           $greetings = "Good Evening";
        } elseif ($hour >= 12) {
            $greetings = "Good Afternoon";
        } elseif ($hour < 12) {
           $greetings = "Good Morning";
        }

        return $greetings .'! ' .$this->name;
    }

    public function isTenant()
    {
        return $this->role == 'tenant';
    }

    public function isRepresntative()
    {
        return $this->role == 'representative';
    }

    public function isAssigner()
    {
        return $this->role == 'assigner';
    }

    public static function search($search)
    {
        return empty($search) ? static::query()
        : static::query()
        ->where('role', '!===', 'super_admin')
        ->where('name', 'like', '%'.$search.'%')
        ->orWhere('badge', 'like', '%'.$search.'%')
        ->orWhere('email', 'like', '%'.$search.'%')
        ->orWhere('mobile', 'like', '%'.$search.'%')
        // ->orWhere('role', 'like', '%'.$search.'%')
        ->orWhere('username', 'like', '%'.$search.'%');
    }

    public static function searchStaff($search)
    {
        return empty($search) ? static::query()
        : static::query()
        // ->where('role', 'staff')
        ->where('name', 'like', '%'.$search.'%')
        ->orWhere('badge', 'like', '%'.$search.'%')
        ->orWhere('email', 'like', '%'.$search.'%')
        ->orWhere('mobile', 'like', '%'.$search.'%')
        ->orWhere('username', 'like', '%'.$search.'%');
    }

}
