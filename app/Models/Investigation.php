<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
<<<<<<< HEAD
    protected $fillable = ['report_id', 'investigator_id', 'findings', 'recommendations'];

    public function report()       { return $this->belongsTo(Report::class); }
    public function investigator() { return $this->belongsTo(User::class, 'investigator_id'); }
=======
    protected $fillable = [
        'report_id',
        'investigator_id',
        'findings',
        'recommendation',
        'investigation_date',
        'status'
    ];

    protected $casts = [
        'investigation_date' => 'date'
    ];

    public function report()
    {
        return $this->belongsTo(
            Report::class
        );
    }

    public function investigator()
    {
        return $this->belongsTo(
            User::class,
            'investigator_id'
        );
    }
>>>>>>> be38a6dd75183943501997739ad1d99c484cc4e9
}