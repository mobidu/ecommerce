<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankProvider extends Model
{
    protected $table = 'bank_provider';
    protected $fillable = ['kode', 'nama', 'logo'];

    
}
