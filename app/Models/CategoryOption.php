<?php

namespace App\Models;

use App\Models\WorkCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_category_id',
        'name',
    ];

    public function category()
    {
        return $this->belongsTo(WorkCategory::class, 'work_category_id');
    }
}
