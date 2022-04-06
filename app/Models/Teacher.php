<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teacher';
    protected $fillable = [
        'tid',
        'tpass',
        'name',
        'email',
        'profile',
        'message_students',
        'created_at',
        'updated_at'
    ];

    public function business_hours()
    {
        return $this->hasOne('App\Models\BusinessHours', 'teacher_id');
    }
    public function status()
    {
        return $this->hasOne('App\Models\CompanyStatus', 'teacher_id');
    }
}
