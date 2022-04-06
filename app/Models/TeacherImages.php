<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherImages extends Model
{
    use HasFactory;
    protected $table = 'teacher_images';

    protected $fillable = [
        'url',
        'teacher_id',
        'created_at',
        'updated_at'
    ];
    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher', 'id');
    }
}
