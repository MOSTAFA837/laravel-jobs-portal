<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class job extends Model
{
    use HasFactory;

    public function getCompany()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function getJobCategory()
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id');
    }

    public function getJobLocation()
    {
        return $this->belongsTo(JobLocation::class, 'job_location_id');
    }

    public function getJobType()
    {
        return $this->belongsTo(JobType::class, 'job_type_id');
    }

    public function getJobExperience()
    {
        return $this->belongsTo(JobExperience::class, 'job_experience_id');
    }

    public function getJobGender()
    {
        return $this->belongsTo(JobGender::class, 'job_gender_id');
    }

    public function getJobSalaryRange()
    {
        return $this->belongsTo(JobSalaryRange::class, 'job_salary_range_id');
    }
}
