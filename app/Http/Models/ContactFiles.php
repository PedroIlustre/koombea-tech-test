<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactFiles extends Model
{
    public $table = "contact_files";

    protected $fillable = [
        'id', 
        'user_id',
        'upload_id',
        'name',
        'birth_date',
        'phone',
        'addres',
        'credit_card',
        'franchise',
        'email'
    ];

    protected $casts = [
        'id'           => 'integer',
        'user_id'      => 'integer',
        'upload_id'    => 'integer',
        'name'         => 'string',
        'phone'        => 'string',
        'addres'       => 'string',
        'credit_card'  => 'string',
        'franchise'    => 'string',
        'email'        => 'string'
    ];

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    public function upload()
    {
        return $this->belongsTo(\App\Http\Models\Upload::class, 'upload_id');
    }
}
