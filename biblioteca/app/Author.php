<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{

    protected $fillable = [
        'name'
    ];

    public function work() {

        return $this->HasMany(Works::class);
        
    }
    
}
