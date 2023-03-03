<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemModel extends Model
{
    protected $table = 'order_items';
    protected $fillable =
    [
        'order_id',
        'pd_id',
        'qty',
        'unit',
        'harga',
        'total_harga',
        'uuid',
        'encrypt_time'
    ];
    protected $guarded = [];

    public function products()
    {
        return $this->belongsTo('App\Product', 'pd_id', 'pd_id');
    }

    public function orders()
    {
        return $this->belongsTo('App\Order', 'order_id', 'order_id');
    }
}
