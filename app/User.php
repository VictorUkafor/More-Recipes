<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * Get the favourite recipes by the user.
     */
    public function favourites()
    {
        return $this->belongsToMany('App\Recipe')
        ->withTimestamps();
    }

    /**
     * Get the recipes by the user.
     */
    public function recipes()
    {
        return $this->hasMany('App\Recipe');
    }

    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
