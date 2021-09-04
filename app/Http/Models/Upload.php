<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'url'
    ];

}
