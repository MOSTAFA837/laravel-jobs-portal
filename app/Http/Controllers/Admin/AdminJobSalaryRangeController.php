<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobSalaryRange;

class AdminJobSalaryRangeController extends Controller
{
    public function index()
    {
        $job_salary_ranges = JobSalaryRange::get();
        return view('admin.job_salary_range.view', compact('job_salary_ranges'));
    }

    public function create()
    {
        return view('admin.job_salary_range.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $obj = new JobSalaryRange();
        $obj->name = $request->name;
        $obj->save();

        return redirect()
            ->route('admin_job_salary_range')
            ->with('success', 'Data is saved successfully.');
    }

    public function edit($id)
    {
        $job_salary_range_single = JobSalaryRange::where('id', $id)->first();
        return view('admin.job_salary_range.edit', compact('job_salary_range_single'));
    }

    public function update(Request $request, $id)
    {
        $obj = JobSalaryRange::where('id', $id)->first();

        $request->validate([
            'name' => 'required',
        ]);

        $obj->name = $request->name;
        $obj->update();

        return redirect()
            ->route('admin_job_salary_range')
            ->with('success', 'Data is updated successfully.');
    }

    public function delete($id)
    {
        // $check = Job::where('job_salary_range_id', $id)->count();
        // if ($check > 0) {
        //     return redirect()
        //         ->back()
        //         ->with('error', 'You can not delete this item, because this is used in another place.');
        // }

        JobSalaryRange::where('id', $id)->delete();
        return redirect()
            ->route('admin_job_salary_range')
            ->with('success', 'Data is deleted successfully.');
    }
}
