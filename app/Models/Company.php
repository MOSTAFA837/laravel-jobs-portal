<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    use HasFactory;

    public function getJob()
    {
        return $this->hasMany(Job::class);
    }

    public function getCompanyIndustry()
    {
        return $this->belongsTo(CompanyIndustry::class, 'company_industry_id');
    }

    public function getCompanyLocation()
    {
        return $this->belongsTo(CompanyLocation::class, 'company_location_id');
    }

    public function getCompanySize()
    {
        return $this->belongsTo(CompanySize::class, 'company_size_id');
    }
}
