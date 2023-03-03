<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaesarModel extends Model
{
    protected $table = 'caesar';
    protected $primaryKey = 'cs_id';

    protected $fillable =
    [
        'cs_nama',
        'cs_email',
        'cs_notelp',
        'cs_alamat',
        'encrypt_time',
    ];

    protected $guarded = [];

    // public $incrementing  = false;

    //use Uuid;
}
