<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageHomeItem;
use App\Models\JobCategory;

class HomeController extends Controller
{
    public function index()
    {
        $home_page_data = PageHomeItem::where('id', 1)->first();
        $job_categories = JobCategory::orderBy('name', 'asc')->get();

        return view('front.home', compact('home_page_data', 'job_categories'));
    }
}
