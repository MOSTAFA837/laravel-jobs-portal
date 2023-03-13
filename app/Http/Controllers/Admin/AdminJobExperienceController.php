<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobExperience;
use App\Models\Job;

class AdminJobExperienceController extends Controller
{
    public function index()
    {
        $job_experiences = JobExperience::get();
        return view('admin.job_experience.job_experience', compact('job_experiences'));
    }

    public function create()
    {
        return view('admin.job_experience.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $obj = new JobExperience();
        $obj->name = $request->name;
        $obj->save();

        return redirect()
            ->route('admin_job_experience')
            ->with('success', 'Data is saved successfully.');
    }

    public function edit($id)
    {
        $job_experience_single = JobExperience::where('id', $id)->first();
        return view('admin.job_experience.edit', compact('job_experience_single'));
    }

    public function update(Request $request, $id)
    {
        $obj = JobExperience::where('id', $id)->first();

        $request->validate([
            'name' => 'required',
        ]);

        $obj->name = $request->name;
        $obj->update();

        return redirect()
            ->route('admin_job_experience')
            ->with('success', 'Data is updated successfully.');
    }

    public function delete($id)
    {
        // $check = Job::where('job_experience_id', $id)->count();
        // if ($check > 0) {
        //     return redirect()
        //         ->back()
        //         ->with('error', 'You can not delete this item, because this is used in another place.');
        // }

        JobExperience::where('id', $id)->delete();
        return redirect()
            ->route('admin_job_experience')
            ->with('success', 'Data is deleted successfully.');
    }
}
