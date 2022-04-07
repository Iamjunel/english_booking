<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherStatus extends Model
{
    use HasFactory;

    protected $table = 'teacher_status';

    protected $fillable = [
        'date',
        'time',
        'comment',
        'status',
        'teacher_id',
        'created_at',
        'updated_at'
    ];
    public function company()
    {
        return $this->belongsTo('App\Models\Teacher', 'id');
    }
}
