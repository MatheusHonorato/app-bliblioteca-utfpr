<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = [
        'siape'
    ];

    public function user() {

        return $this->belongsTo(User::class);

    }
}
