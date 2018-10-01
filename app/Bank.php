<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = ['nama_pemilik', 'no_rekening', 'id_bank'];

    public function provider()
    {
        return $this->hasOne('App\BankProvider', 'id', 'id_bank');
    }
}
