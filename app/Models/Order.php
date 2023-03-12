<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function getCompany()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function getPackage()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
}
