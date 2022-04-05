<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyStatus extends Model
{
    use HasFactory;

    protected $table = 'company_status';

    protected $fillable = [
        'date',
        'time',
        'comment',
        'status',
        'company_id',
        'company_id',
        'created_at',
        'updated_at'
    ];
    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'id');
    }
}
