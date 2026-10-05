<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evidence extends Model
{
    protected $fillable = [
        'report_id',
        'file_name',
        'file_path',
        'file_type',
        'file_size'
    ];

    public function report()
    {
        return $this->belongsTo(
            Report::class
        );
    }
}