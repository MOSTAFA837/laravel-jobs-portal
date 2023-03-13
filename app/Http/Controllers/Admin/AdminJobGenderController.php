<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobGender;
use App\Models\Job;

class AdminJobGenderController extends Controller
{
    public function index()
    {
        $job_genders = JobGender::get();
        return view('admin.job_gender.view', compact('job_genders'));
    }

    public function create()
    {
        return view('admin.job_gender.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $obj = new JobGender();
        $obj->name = $request->name;
        $obj->save();

        return redirect()
            ->route('admin_job_gender')
            ->with('success', 'Data is saved successfully.');
    }

    public function edit($id)
    {
        $job_gender_single = JobGender::where('id', $id)->first();
        return view('admin.job_gender.edit', compact('job_gender_single'));
    }

    public function update(Request $request, $id)
    {
        $obj = JobGender::where('id', $id)->first();

        $request->validate([
            'name' => 'required',
        ]);

        $obj->name = $request->name;
        $obj->update();

        return redirect()
            ->route('admin_job_gender')
            ->with('success', 'Data is updated successfully.');
    }

    public function delete($id)
    {
        // $check = Job::where('job_gender_id', $id)->count();
        // if ($check > 0) {
        //     return redirect()
        //         ->back()
        //         ->with('error', 'You can not delete this item, because this is used in another place.');
        // }

        JobGender::where('id', $id)->delete();
        return redirect()
            ->route('admin_job_gender')
            ->with('success', 'Data is deleted successfully.');
    }
}
