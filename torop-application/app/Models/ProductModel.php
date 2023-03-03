<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'pd_id';

    protected $fillable =
    [
        'pd_kategori',
        'pd_brand',
        'pd_nama',
        'pd_tipe',
        'pd_design',
        'pd_material',
        'pd_harga',
        'uuid',
        'encrypt_time',
    ];

    protected $guarded = [];

    public function items()
    {
        return $this->belongsToMany('App\Item', 'pd_id', 'pd_id');
    }
}
