<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageHomeItem;

class AdminHomePageController extends Controller
{
    public function index()
    {
        $page_home_data = PageHomeItem::where('id', 1)->first();
        return view('admin.page_home', compact('page_home_data'));
    }

    public function update(Request $request)
    {
        $home_page_data = PageHomeItem::where('id', 1)->first();

        $request->validate([
            'heading' => 'required',
            'job_title' => 'required',
            'job_category' => 'required',
            'job_location' => 'required',
            'search' => 'required',
            'job_category_heading' => 'required',
            'job_category_status' => 'required',
            'featured_jobs_heading' => 'required',
            'featured_jobs_subheading' => 'required',
        ]);

        if ($request->hasFile('background')) {
            $request->validate([
                'background' => 'image|mimes:jpg,jpeg,png,gif',
            ]);

            unlink(public_path('uploads/' . $home_page_data->background));

            $ext = $request->file('background')->extension();
            $final_name = 'banner_home' . '.' . $ext;

            $request->file('background')->move(public_path('uploads/'), $final_name);

            $home_page_data->background = $final_name;
        }

        $home_page_data->heading = $request->heading;
        $home_page_data->text = $request->text;
        $home_page_data->job_title = $request->job_title;
        $home_page_data->job_category = $request->job_category;
        $home_page_data->job_location = $request->job_location;
        $home_page_data->search = $request->search;

        $home_page_data->job_category_heading = $request->job_category_heading;
        $home_page_data->job_category_subheading = $request->job_category_subheading;
        $home_page_data->job_category_status = $request->job_category_status;

        $home_page_data->featured_jobs_heading = $request->featured_jobs_heading;
        $home_page_data->featured_jobs_subheading = $request->featured_jobs_subheading;
        $home_page_data->featured_jobs_status = $request->featured_jobs_status;

        $home_page_data->update();

        return redirect()
            ->back()
            ->with('success', 'Data is updated successfully.');
    }
}
