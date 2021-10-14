<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{

    public $table = "uploads";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'url'
    ];

}
