<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageHomeItem;
use App\Models\JobCategory;
use App\Models\JobLocation;
use App\Models\WhyChooseItem;

class HomeController extends Controller
{
    public function index()
    {
        $home_page_data = PageHomeItem::where('id', 1)->first();
        $all_job_categories = JobCategory::orderBy('name', 'asc')->get();
        $job_categories = JobCategory::orderBy('name', 'asc')
            ->take(9)
            ->get();
        $job_locations = JobLocation::orderBy('name', 'asc')->get();
        $why_choose_items = WhyChooseItem::get();

        return view('front.home', compact('home_page_data', 'job_categories', 'why_choose_items', 'job_locations', 'all_job_categories'));
    }
}
