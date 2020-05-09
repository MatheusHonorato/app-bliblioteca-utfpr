<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function userable() {

        return $this->morphTo();

    }

    public function phones() {

        return $this->HasOne(Phone::class);

    }

    public function loans() {

        return $this->HasMany(Loan::class);
        
    }

    public function server() {

        return $this->HasMany(Server::class);

    }

    public function student() {

        return $this->HasOne(Student::class);

    }
}
