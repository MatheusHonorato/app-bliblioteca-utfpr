<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{

    protected $fillable = [
        'user_id', 'exemplary_id', 'devolution_id', 'loan_date', 'return_date_expected'
    ];

    public function user() {

        return $this->belongsTo(User::class);

    }

    
    public function devolution() {

        return $this->belongsTo(Devolution::class);

    }

    public function exemplary() {

        return $this->belongsTo(Exemplary::class);

    }
}
