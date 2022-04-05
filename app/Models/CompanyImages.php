<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyImages extends Model
{
    use HasFactory;

    protected $table = 'company_images';

    protected $fillable = [
        'url',
        'company_id',
        'created_at',
        'updated_at'
    ];
    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'id');
    }
}
