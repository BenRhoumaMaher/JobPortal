<?php

namespace App\Models\Job;

use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'job_title',
        'job_region',
        'job_type',
        'vacancy',
        'experience',
        'salary',
        'gender',
        'application_deadline',
        'jobdescription',
        'responsabilities',
        'education_experience',
        'otherbenifits',
        'image',
    ];
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category', 'name');
    }
}
