<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'company';

    protected $fillable = [
        'cid',
        'cpass',
        'name',
        'email',
        'address',
        'phone',
        'fax',
        'hp',
        'notes',
        'holidays',
        'pricelist',
        'has_nursing',
        'has_helper',
        'has_ventilator',
        'has_oxygen',
        'created_at',
        'updated_at'
    ];

    public function business_hours(){
        return $this->hasOne('App\Models\BusinessHours','company_id');
    }
    public function status()
    {
        return $this->hasOne('App\Models\CompanyStatus', 'company_id');
    }
}
