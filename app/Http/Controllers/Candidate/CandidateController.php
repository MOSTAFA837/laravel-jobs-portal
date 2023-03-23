<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\CandidateEducation;
use App\Models\CandidateSkill;
use App\Models\CandidateExperience;
use Illuminate\Validation\Rule;
use Auth;
use Hash;

class CandidateController extends Controller
{
    public function dashboard()
    {
        return view('candidate.dashboard');
    }

    public function edit_profile()
    {
        return view('candidate.edit_profile');
    }

    public function edit_profile_update(Request $request)
    {
        $obj = Candidate::where('id', Auth::guard('candidate')->user()->id)->first();
        $id = $obj->id;

        $request->validate([
            'name' => 'required',
            'username' => ['required', 'alpha_dash', Rule::unique('candidates')->ignore($id)],
            'email' => ['required', 'email', Rule::unique('candidates')->ignore($id)],
        ]);

        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif',
            ]);

            if (Auth::guard('candidate')->user()->photo != '') {
                unlink(public_path('uploads/' . $obj->photo));
            }

            $ext = $request->file('photo')->extension();
            $final_name = 'candidate_photo_' . time() . '.' . $ext;

            $request->file('photo')->move(public_path('uploads/'), $final_name);

            $obj->photo = $final_name;
        }

        $obj->name = $request->name;
        $obj->designation = $request->designation;
        $obj->username = $request->username;
        $obj->email = $request->email;
        $obj->biography = $request->biography;
        $obj->phone = $request->phone;
        $obj->country = $request->country;
        $obj->address = $request->address;
        $obj->state = $request->state;
        $obj->city = $request->city;
        $obj->zip_code = $request->zip_code;
        $obj->gender = $request->gender;
        $obj->marital_status = $request->marital_status;
        $obj->date_of_birth = $request->date_of_birth;
        $obj->website = $request->website;
        $obj->update();

        return redirect()
            ->back()
            ->with('success', 'Profile has been updated successfully.');
    }

    public function edit_password()
    {
        return view('candidate.edit_password');
    }

    public function edit_password_update(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'retype_password' => 'required|same:password',
        ]);

        $obj = Candidate::where('id', Auth::guard('candidate')->user()->id)->first();
        $obj->password = Hash::make($request->password);
        $obj->update();

        return redirect()
            ->back()
            ->with('success', 'Password is updated successfully.');
    }

    public function education()
    {
        $educations = CandidateEducation::where('candidate_id', Auth::guard('candidate')->user()->id)
            ->orderBy('id', 'desc')
            ->get();
        return view('candidate.education', compact('educations'));
    }

    public function education_create()
    {
        return view('candidate.education_create');
    }

    public function education_store(Request $request)
    {
        $request->validate([
            'level' => 'required',
            'institute' => 'required',
            'degree' => 'required',
            'passing_year' => 'required',
        ]);

        $obj = new CandidateEducation();
        $obj->candidate_id = Auth::guard('candidate')->user()->id;
        $obj->level = $request->level;
        $obj->institute = $request->institute;
        $obj->degree = $request->degree;
        $obj->passing_year = $request->passing_year;
        $obj->save();

        return redirect()
            ->route('candidate_education')
            ->with('success', 'Education has been added successfully.');
    }

    public function education_edit($id)
    {
        $education_single = CandidateEducation::where('id', $id)->first();

        return view('candidate.education_edit', compact('education_single'));
    }

    public function education_update(Request $request, $id)
    {
        $obj = CandidateEducation::where('id', $id)->first();

        $request->validate([
            'level' => 'required',
            'institute' => 'required',
            'degree' => 'required',
            'passing_year' => 'required',
        ]);

        $obj->level = $request->level;
        $obj->institute = $request->institute;
        $obj->degree = $request->degree;
        $obj->passing_year = $request->passing_year;
        $obj->update();

        return redirect()
            ->route('candidate_education')
            ->with('success', 'Education has been updated successfully.');
    }

    public function education_delete($id)
    {
        CandidateEducation::where('id', $id)->delete();
        return redirect()
            ->route('candidate_education')
            ->with('success', 'Education has been deleted successfully.');
    }

    public function skill()
    {
        $skills = CandidateSkill::where('candidate_id', Auth::guard('candidate')->user()->id)
            ->orderBy('id', 'desc')
            ->get();
        return view('candidate.skill', compact('skills'));
    }

    public function skill_create()
    {
        return view('candidate.skill_create');
    }

    public function skill_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'percentage' => 'required',
        ]);

        $obj = new CandidateSkill();
        $obj->candidate_id = Auth::guard('candidate')->user()->id;
        $obj->name = $request->name;
        $obj->percentage = $request->percentage;
        $obj->save();

        return redirect()
            ->route('candidate_skill')
            ->with('success', 'Skill has been added successfully.');
    }

    public function skill_edit($id)
    {
        $skill_single = CandidateSkill::where('id', $id)->first();

        return view('candidate.skill_edit', compact('skill_single'));
    }

    public function skill_update(Request $request, $id)
    {
        $obj = CandidateSkill::where('id', $id)->first();

        $request->validate([
            'name' => 'required',
            'percentage' => 'required',
        ]);

        $obj->name = $request->name;
        $obj->percentage = $request->percentage;
        $obj->update();

        return redirect()
            ->route('candidate_skill')
            ->with('success', 'Skill has been updated successfully.');
    }

    public function skill_delete($id)
    {
        CandidateSkill::where('id', $id)->delete();
        return redirect()
            ->route('candidate_skill')
            ->with('success', 'Skill has been deleted successfully.');
    }

    public function experience()
    {
        $experiences = CandidateExperience::where('candidate_id', Auth::guard('candidate')->user()->id)
            ->orderBy('id', 'desc')
            ->get();
        return view('candidate.experience', compact('experiences'));
    }

    public function experience_create()
    {
        return view('candidate.experience_create');
    }

    public function experience_store(Request $request)
    {
        $request->validate([
            'company' => 'required',
            'designation' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $obj = new CandidateExperience();
        $obj->candidate_id = Auth::guard('candidate')->user()->id;
        $obj->company = $request->company;
        $obj->designation = $request->designation;
        $obj->start_date = $request->start_date;
        $obj->end_date = $request->end_date;
        $obj->save();

        return redirect()
            ->route('candidate_experience')
            ->with('success', 'Experience is added successfully.');
    }

    public function experience_edit($id)
    {
        $experience_single = CandidateExperience::where('id', $id)->first();

        return view('candidate.experience_edit', compact('experience_single'));
    }

    public function experience_update(Request $request, $id)
    {
        $obj = CandidateExperience::where('id', $id)->first();

        $request->validate([
            'company' => 'required',
            'designation' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $obj->company = $request->company;
        $obj->designation = $request->designation;
        $obj->start_date = $request->start_date;
        $obj->end_date = $request->end_date;
        $obj->update();

        return redirect()
            ->route('candidate_experience')
            ->with('success', 'Experience is updated successfully.');
    }

    public function experience_delete($id)
    {
        CandidateExperience::where('id', $id)->delete();
        return redirect()
            ->route('candidate_experience')
            ->with('success', 'Experience is deleted successfully.');
    }
}
