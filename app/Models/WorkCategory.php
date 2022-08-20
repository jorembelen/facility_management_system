<?php

namespace App\Models;

use App\Models\CategoryOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function option()
    {
        return $this->hasMany(CategoryOption::class);
    }
}
