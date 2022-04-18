<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'student';
    protected $fillable = [
        'sid',
        'spass',
        'name',
        'email',
        'jp_name',
        'eng_name',
        'course',
        'memo',
        'created_at',
        'updated_at'
    ];
}
