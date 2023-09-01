<?php

namespace App\Models\Category;

use App\Models\Job\Job;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at',
    ];
    public function jobs()
    {
        return $this->hasMany(Job::class, 'category', 'name');
    }
}
