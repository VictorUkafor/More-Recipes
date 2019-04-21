<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{

    use SoftDeletes;

    /**
     * Get the user that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the reactions for the recipe.
     */
    public function reactions()
    {
        return $this->hasMany('App\Reaction');
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'ingredients',
        'method',
        'image',
    ];
}
