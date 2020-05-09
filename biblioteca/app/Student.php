<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'ra'
    ];

    public function user() {

        return $this->belongsTo(User::class);

    }
}
