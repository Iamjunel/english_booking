<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookedLog extends Model
{
    use HasFactory;

    protected $table = 'booked_logs';
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
    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'id');
    }
}
