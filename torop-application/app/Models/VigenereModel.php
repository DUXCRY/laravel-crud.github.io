<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VigenereModel extends Model
{
    protected $table = 'vigenere';
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
