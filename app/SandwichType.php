<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SandwichType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'price'
    ];
}
