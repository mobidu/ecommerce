<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

//Route::group(['middleware' => ['admin']], function () {

//Route Login
Route::get('/login', 'front\AuthController@showLoginForm');
Route::post('/login', 'front\AuthController@login');
Route::post('/logout', 'front\AuthController@logout');
Route::get('/register', 'front\RegisterController@showRegistrationForm');
Route::post('/register', 'front\RegisterController@register');

//Route Reset
Route::post('/password/email', 'front\PasswordController@sendResetLinkEmail');
Route::post('/password/reset', 'front\PasswordController@reset');
Route::get('/password/reset/{token?}', 'front\PasswordController@showResetForm');

//Homepage
Route::get('/', 'front\HomepageController@index');
Route::get('/profil', 'front\ProfilController@index');
Route::get('/affiliate', 'front\ProfilController@affiliate');

Route::get('/cart', 'front\HomepageController@cart');
Route::post('/cart', 'front\HomepageController@proses_cart');
Route::get('/d_cart', 'front\HomepageController@delete_cart');

//Pembayaran
Route::get('/konfirmasi-pembayaran', 'front\HomepageController@ConfirmPembayaran');
Route::post('/konfirmasi-pembayaran', 'front\HomepageController@simpanInvoice');
Route::post('/cek-invoice', ['as' => 'pembayaran.cekinvoice', 'uses' => 'front\HomepageController@cekInvoice']);

//Testimoni
Route::get('/testimoni', 'TestimoniController@isiTestimoni');
Route::post('/testimoni', 'TestimoniController@createTestimoni');

//Page
Route::get('/p/{slug}', 'front\HomepageController@frontPage');

// Menu Order
Route::get('/order', 'front\OrderController@index');
Route::get('/order/detail/{invoice}', 'front\OrderController@order_detail');
Route::get('/order/data/aktif', 'front\OrderController@order_data_aktif');
Route::get('/order/data/selesai', 'front\OrderController@order_data_selesai');
Route::get('/order/data/batal', 'front\OrderController@order_data_batal');

//category
Route::get('/kategori/{slug}', 'front\HomepageController@kategori');

//Product Detail
Route::get('/produk/{id}', 'front\HomepageController@show');

//Checkout
Route::get('/checkout', 'front\HomepageController@checkout');
Route::post('/city', 'front\HomepageController@getCity');
Route::post('/ongkir', 'front\HomepageController@ongkir');
Route::post('/update_cart', 'front\HomepageController@update_cart');

//Transaction
Route::post('/checkout', 'front\TransactionController@store');
Route::get('/finish', 'front\TransactionController@finishTransaction');

//});

//Route Login
Route::get('/admin/login', 'Auth\AuthController@showLoginForm');
Route::post('/admin/login', 'Auth\AuthController@login');
Route::get('/admin/logout', 'Auth\AuthController@logout');
//Route Reset
Route::post('/admin/password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('/admin/password/reset', 'Auth\PasswordController@reset');
Route::get('/admin/password/reset/{token?}', 'Auth\PasswordController@showResetForm');

//Route::group(['middleware' => 'admin'], function () {

//Route Dashboard
Route::get('/admin/home', 'HomeController@index');

//Route Setting
Route::get('/admin/setting', ['as' => 'setting.index', 'uses' => 'SettingController@index']);

//    Route::post('/admin/setting', 'SettingController@simpan');
Route::post('/admin/setting/kabupaten', ['as' => 'setting.getkabupaten', 'uses' => 'SettingController@getKabupaten']);
Route::post('/admin/setting/update', ['as' => 'setting.update', 'uses' => 'SettingController@update']);

//Route Pembayaran
Route::get('/admin/pembayaran', 'PembayaranController@index');
Route::get('/admin/pembayaran/data', 'PembayaranController@data');
Route::get('/admin/pembayaran/{invoice}', 'PembayaranController@detile');
Route::post('/admin/pembayaran/konfirmasi/{invoice}', 'PembayaranController@konfirmasi');

//Route categori
Route::get('/admin/category', ['as' => 'kategori', 'uses' => 'CategoryController@index']);
Route::post('/admin/category', ['as' => 'kategori.store', 'uses' => 'CategoryController@store']);
Route::post('/admin/category/slug', ['as' => 'kategori.slug', 'uses' => 'CategoryController@getSlug']);
Route::delete('/admin/category/{id}', ['as' => 'kategori.destroy', 'uses' => 'CategoryController@destroy']);
//Route Supplier
Route::resource('/admin/supplier', 'SupplierController');
Route::post('/admin/supplier/getdata', ['as' => 'autocomplete.supplier', 'uses' => 'SupplierController@getKota']);

//Route Product
Route::resource('/admin/product', 'ProductController');
Route::post('/admin/product/slug', ['as' => 'product.slug', 'uses' => 'ProductController@getSlug']);
Route::post('/admin/product/image/upload', 'ProductController@uploadImage');
Route::post('/admin/product/kode', ['as' => 'product.kode', 'uses' => 'ProductController@getKode']);
Route::post('/admin/product/hapus', ['as' => 'product.hapusgambar', 'uses' => 'ProductController@hapusGambar']);

//Route Order
Route::get('/admin/order', ['as' => 'order.index', 'uses' => 'OrderController@index']);
Route::get('/admin/order/{invoice}', ['as' => 'order.detail', 'uses' => 'OrderController@detail_order']);
Route::post('/admin/status-order', ['as' => 'order.status_order', 'uses' => 'OrderController@updateStatusOrder']);
Route::get('/admin/waiting-payment', ['as' => 'order.waiting-payment', 'uses' => 'OrderController@waiyPayment']);

//Route Slide
Route::get('/admin/slide', ['as' => 'slide.index', 'uses' => 'SlideController@index']);
Route::post('/admin/slide', ['as' => 'slide.create', 'uses' => 'SlideController@create']);
Route::delete('/admin/slide/{id}', ['as' => 'slide.destroy', 'uses' => 'SlideController@destroy']);

//Route Pages
Route::get('/admin/pages', ['as' => 'pages.index', 'uses' => 'PageController@index']);
Route::get('/admin/pages/create', ['as' => 'pages.create', 'uses' => 'PageController@create']);
Route::post('/admin/pages/create', ['as' => 'pages.store', 'uses' => 'PageController@store']);
Route::delete('/admin/pages/{id}', ['as' => 'page.delete', 'uses' => 'PageController@destroy']);
Route::get('/admin/pages/{id}/edit', ['as' => 'page.edit', 'uses' => 'PageController@edit']);
Route::put('/admin/pages/{id}', ['as' => 'page.update', 'uses' => 'PageController@update']);

//Route Bank
Route::get('/admin/bank', ['as' => 'admin.index_provider', 'uses' => 'BankController@index_provider']);
Route::post('/admin/bank', ['as' => 'admin.simpan_bank_provider', 'uses' => 'BankController@simpan_bank_provider']);
Route::post('/admin/bank/hapus/{id}', ['as' => 'admin.hapus_bank_provider', 'uses' => 'BankController@hapus_bank_provider']);
Route::get('/admin/payment', ['as' => 'payment.index', 'uses' => 'BankController@index']);
Route::post('/admin/payment', ['as' => 'payment.store', 'uses' => 'BankController@store']);
Route::delete('/admin/payment/{id}', ['as' => 'payment.destroy', 'uses' => 'BankController@destroy']);

//Route Testimoni
Route::get('/admin/testimoni', ['as' => 'testimoni.index', 'uses' => 'TestimoniController@index']);
Route::get('/admin/testimoni/{id}/edit', ['as' => 'testimoni.edit', 'uses' => 'TestimoniController@edit']);
Route::put('/admin/testimoni/{id}', ['as' => 'testimoni.update', 'uses' => 'TestimoniController@update']);
Route::delete('/admin/testimoni/{id}', ['as' => 'testimoni.destroy', 'uses' => 'TestimoniController@destroy']);

//});
