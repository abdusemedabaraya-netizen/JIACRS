<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
    protected $fillable = ['report_id', 'investigator_id', 'findings', 'recommendations'];

    public function report()       { return $this->belongsTo(Report::class); }
    public function investigator() { return $this->belongsTo(User::class, 'investigator_id'); }
}