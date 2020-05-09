<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exemplary extends Model
{
    
    protected $fillable = [
        'works_id', 'acquisition_date', 'situation'
    ];

    public function works() {

        return $this->belongsTo(Works::class);

    }

    public function loan() {

        return $this->belongsTo(Loan::class);
        
    }
}
