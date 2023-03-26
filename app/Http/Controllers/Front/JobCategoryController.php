<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobCategory;

class JobCategoryController extends Controller
{
    public function categories()
    {
        $job_categories = JobCategory::withCount('getJobs')
            ->orderBy('get_jobs_count', 'desc')
            ->get();

        return view('front.job_categories', compact('job_categories'));
    }
}
