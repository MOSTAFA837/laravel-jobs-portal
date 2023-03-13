<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobLocation;
// use App\Models\Job;

class AdminJobLocationController extends Controller
{
    public function index()
    {
        $job_locations = JobLocation::get();
        return view('admin.job_location.job_location', compact('job_locations'));
    }

    public function create()
    {
        return view('admin.job_location.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $obj = new JobLocation();
        $obj->name = $request->name;
        $obj->save();

        return redirect()
            ->route('admin_job_location')
            ->with('success', 'Data is saved successfully.');
    }

    public function edit($id)
    {
        $job_location_single = JobLocation::where('id', $id)->first();

        return view('admin.job_location.edit', compact('job_location_single'));
    }

    public function update(Request $request, $id)
    {
        $obj = JobLocation::where('id', $id)->first();

        $request->validate([
            'name' => 'required',
        ]);

        $obj->name = $request->name;
        $obj->update();

        return redirect()
            ->route('admin_job_location')
            ->with('success', 'Data is updated successfully.');
    }

    public function delete($id)
    {
        // $check = Job::where('job_location_id', $id)->count();
        // if ($check > 0) {
        //     return redirect()
        //         ->back()
        //         ->with('error', 'You can not delete this item, because this is used in another place.');
        // }

        JobLocation::where('id', $id)->delete();
        return redirect()
            ->route('admin_job_location')
            ->with('success', 'Data is deleted successfully.');
    }
}
