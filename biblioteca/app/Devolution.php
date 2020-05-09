<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devolution extends Model
{
    protected $fillable = [
        'date_devolution'
    ];

    public function loan() {

        return $this->HasOne(Loan::class);

    }
}
