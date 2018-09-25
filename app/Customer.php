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

}
