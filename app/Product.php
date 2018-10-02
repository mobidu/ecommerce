<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Product extends Model
{
    protected $fillable = ['kode_produk', 'nama_produk', 'slug', 'kategori_id', 'supplier_id','komisi', 'deskripsi', 'berat', 'harga', 'stok', 'media_image_id', 'publish', 'diskon', 'harga_jual'];

    public function media_image() {
    	return $this->belongsTo('App\Media_image');
    }

    public function category() {
    	return $this->belongsTo('App\Category', 'kategori_id', 'id');
    }

    public function supplier() {
    	return $this->belongsTo('App\Supplier');
    }

    static function editStokBarang($kode_barang, $jumlah_stok){
        $product = self::where('kode_produk', '=', $kode_barang)->first();
        $product->stok = $product->stok - $jumlah_stok;
        if($product->save()){
            \Log::info('Berhasil Merubah Data Stok Barang!');
        }
    }


}
