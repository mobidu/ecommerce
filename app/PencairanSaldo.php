<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PencairanSaldo extends Model
{
    protected $table = 'pencairan_saldo';

    public function penarikan()
    {
        return $this->hasOne('App\PenarikanSaldo', 'id', 'id_penarikan');
    }
}
