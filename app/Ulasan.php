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
}
