<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Type;

class Works extends Model
{
    protected $fillable = [
        'title', 'year', 'type_id', 'author_id'
    ];

    public function type() {

        return $this->belongsTo(Type::class);
        
    }

    public function author() {

        return $this->belongsTo(Author::class);
        
    }

    public function exemplaries() {

        return $this->HasMany(Exemplary::class);
        
    }
}


