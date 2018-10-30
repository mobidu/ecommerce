<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenarikanSaldo extends Model
{
    protected $table = 'penarikan_saldo';

    protected $with = 'customer';

    public function customer()
    {
        return $this->hasOne('App\Customer', 'affiliate_id', 'id_affiliate');
    }
}
