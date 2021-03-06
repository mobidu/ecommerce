<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;

class Customer extends Authenticable
{
//    protected $guard = 'admin';
//    protected $table = 'customers';
    protected $guarded = 'customer';

    protected $fillable = ['nama_lengkap', 'no_hp', 'email', 'pinbbm', 'username', 'password', 'referred_by', 'affiliate_id'];

    public function order()
    {
    	return $this->hasMany('App\Order');
    }

    public function order_detail()
    {
    	return $this->hasManyThrough('App\Order_detail', 'App\Order');
    }

    public function saldo()
    {
        return $this->hasMany('App\Saldo', 'customer_id', 'id');
    }

    public function referal()
    {
        return $this->hasOne(self::class, 'affiliate_id', 'referred_by');
    }

    public function affiliasi()
    {
        return $this->hasMany(self::class, 'referred_by', 'affiliate_id');
    }

    public function penarikan()
    {
        return $this->hasMany('App\PenarikanSaldo', 'id_affiliate', 'affiliate_id');
    }

    public function ulasan()
    {
        return $this->hasMany('App\Ulasan', 'id_customer', 'id');
    }

}
