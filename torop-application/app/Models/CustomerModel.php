<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'cs_id';

    protected $fillable =
    [
        'cs_nama',
        'cs_email',
        'cs_notelp',
        'cs_alamat',
        'encrypt_time',
        'uuid'
    ];

    protected $guarded = [];

    public function projects()
    {
        return $this->hasMany('App\Project', 'cs_id');
    }
}
