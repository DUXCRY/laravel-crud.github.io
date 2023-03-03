<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    protected $fillable =
    [
        'kd_project',
        'total',
        'uuid'
    ];
    protected $guarded = [];

    public function projects()
    {
        return $this->hasMany('App\Project', 'kd_project', 'kd_project');
    }

    public function items()
    {
        return $this->hasMany('App\Item', 'order_id', 'order_id');
    }

    public function getTaxAttribute()
    {
        return (2 / 100) * $this->total;
    }

    public function getTotalPriceAttribute()
    {
        return ($this->total + (($this->total * 2) / 100));
    }
}
