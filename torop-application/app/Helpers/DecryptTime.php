<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class DecryptTime
{

    private $decrypt_time;

    function __construct($te, $ts)
    {
        return $this->decrypt_time = number_format(($te - $ts), 9);
    }

    function decryptTime($data)
    {
        $this->decrypt_time;
        if (Request::is('customer')) {
            DB::update('update customers set decrypt_time = ' . $this->decrypt_time . ' where cs_id = ?', [$data]);
        }
        if (Request::is('customer/caesar')) {
            DB::update('update caesar set decrypt_time = ' . $this->decrypt_time . ' where cs_id = ?', [$data]);
        }
        if (Request::is('customer/vigenere')) {
            DB::update('update vigenere set decrypt_time = ' . $this->decrypt_time . ' where cs_id = ?', [$data]);
        } else if (Request::is('product')) {
            DB::update('update products set decrypt_time = ' . $this->decrypt_time . ' where pd_id = ?', [$data]);
        } else if (Request::is('project')) {
            DB::update('update projects set decrypt_time = ' . $this->decrypt_time . ' where kd_project = ?', [$data]);
        } else if (Request::is('order/*/edit')) {
            DB::update('update order_items set decrypt_time = ' . $this->decrypt_time . ' where id = ?', [$data]);
        } else if (Request::is('progress')) {
            DB::update('update progress set decrypt_time = ' . $this->decrypt_time . ' where pg_id = ?', [$data]);
        }
    }
}
