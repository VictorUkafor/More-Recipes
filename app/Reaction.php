<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    /**
     * Get the recipe that owns the reaction.
     */
    public function recipe()
    {
        return $this->belongsTo('App\Recipe');
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['vote', 'user_id','recipe_id'];
}
