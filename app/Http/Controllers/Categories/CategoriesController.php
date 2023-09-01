<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\Job\Job;

class CategoriesController extends Controller
{
    public function singleCategory(Category $category, Job $job)
    {
        $jobs = $category->jobs()->get();
        $category = $category->name;
        return view('categories.single')->with([
            'jobs' => $jobs,
            'category' => $category,
        ]);
    }
}
