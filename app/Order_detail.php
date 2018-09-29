<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    protected $fillable = ['order_id', 'kode_produk', 'nama_produk', 'qty', 'berat', 'harga'];

    protected $with = 'product';

    public function order()
    {
    	return $this->belongsTo('App\Order');
    }

    public function product()
    {
        return $this->hasOne('App\Product', 'kode_produk', 'kode_produk');
    }
}
