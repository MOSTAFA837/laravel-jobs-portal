<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageHomeItem;
use App\Models\JobCategory;
use App\Models\JobLocation;
use App\Models\Job;
use App\Models\WhyChooseItem;

class HomeController extends Controller
{
    public function index()
    {
        $home_page_data = PageHomeItem::where('id', 1)->first();
        $all_job_categories = JobCategory::orderBy('name', 'asc')->get();
        $job_categories = JobCategory::withCount('getJobs')
            ->orderBy('get_jobs_count', 'desc')
            ->take(6)
            ->get();
        $job_locations = JobLocation::orderBy('name', 'asc')->get();
        $why_choose_items = WhyChooseItem::get();

        $featured_jobs = Job::orderBy('id', 'desc')
            ->where('is_featured', 1)
            ->take(6)
            ->get();

        $featured_jobs_count = Job::orderBy('id', 'desc')
            ->where('is_featured', 1)
            ->count();

        return view('front.home', compact('home_page_data', 'job_categories', 'why_choose_items', 'job_locations', 'all_job_categories', 'featured_jobs', 'featured_jobs_count'));
    }
}
