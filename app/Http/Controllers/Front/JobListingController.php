<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobLocation;
use App\Models\JobType;
use App\Models\JobExperience;
use App\Models\JobGender;
use App\Models\JobSalaryRange;
use App\Mail\Websitemail;

class JobListingController extends Controller
{
    public function index(Request $request)
    {
        $job_categories = JobCategory::orderBy('name', 'asc')->get();
        $job_locations = JobLocation::orderBy('name', 'asc')->get();
        $job_types = JobType::orderBy('name', 'asc')->get();
        $job_experiences = JobExperience::orderBy('name', 'asc')->get();
        $job_genders = JobGender::orderBy('name', 'asc')->get();
        $job_salary_ranges = JobSalaryRange::orderBy('name', 'asc')->get();

        $form_title = $request->title;
        $form_category = $request->category;
        $form_location = $request->location;
        $form_type = $request->type;
        $form_experience = $request->experience;
        $form_gender = $request->gender;
        $form_salary_range = $request->salary_range;

        $jobs = Job::orderBy('id', 'desc');

        if ($form_title != null) {
            $jobs = $jobs->where('title', 'LIKE', '%' . $form_title . '%');
        }

        if ($form_category != null) {
            $jobs = $jobs->where('job_category_id', $form_category);
        }

        if ($form_location != null) {
            $jobs = $jobs->where('job_location_id', $form_location);
        }

        if ($form_type != null) {
            $jobs = $jobs->where('job_type_id', $form_type);
        }

        if ($form_experience != null) {
            $jobs = $jobs->where('job_experience_id', $form_experience);
        }

        if ($form_gender != null) {
            $jobs = $jobs->where('job_gender_id', $form_gender);
        }

        if ($form_salary_range != null) {
            $jobs = $jobs->where('job_salary_range_id', $form_salary_range);
        }

        $jobs = $jobs->paginate(1);

        return view('front.job_listing', compact('jobs', 'job_categories', 'job_locations', 'job_types', 'job_experiences', 'job_genders', 'job_salary_ranges', 'form_title', 'form_category', 'form_location', 'form_type', 'form_experience', 'form_gender', 'form_salary_range'));
    }

    public function details($id)
    {
        $job_single = Job::where('id', $id)->first();

        $related_jobs = Job::where('job_category_id', $job_single->job_category_id)->get();

        return view('front.job', compact('job_single', 'related_jobs'));
    }

    public function send_email(Request $request)
    {
        $request->validate([
            'visitor_name' => 'required',
            'visitor_email' => 'required|email',
            'visitor_message' => 'required',
        ]);

        $subject = 'Enquery for job: ' . $request->job_title;
        $message = 'Visitor Informations: <br>';
        $message .= 'Name: ' . $request->visitor_name . '<br>';
        $message .= 'Email: ' . $request->visitor_email . '<br>';
        $message .= 'Phone: ' . $request->visitor_phone . '<br>';
        $message .= 'Message: ' . $request->visitor_message;

        \Mail::to($request->company_email)->send(new Websitemail($subject, $message));

        return redirect()
            ->back()
            ->with('success', 'Email has been sent successfully!');
    }
}
