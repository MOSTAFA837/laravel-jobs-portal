<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateBookmark extends Model
{
    use HasFactory;

    public function getCandidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    public function getJob()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
}
