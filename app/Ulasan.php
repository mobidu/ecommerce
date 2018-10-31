<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table = 'ulasan';

    public function customer()
    {
        return $this->hasOne('App\Customer', 'id', 'id_customer');
    }

    public function order()
    {
        return $this->hasOne('App\Order', 'id', 'id_order');
    }
}
