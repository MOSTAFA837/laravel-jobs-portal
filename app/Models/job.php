<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class job extends Model
{
    use HasFactory;

    public function getJobCategory()
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id');
    }

    public function getJobLocation()
    {
        return $this->belongsTo(JobLocation::class, 'job_location_id');
    }
}
