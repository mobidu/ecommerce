<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Customer::class, function (Faker\Generator $faker) {
    return [
        'nama_lengkap' => $faker->name,
        'email' => $faker->email,
        'no_hp' => $faker->phoneNumber,
        'username' => $faker->userName,
        'password' => bcrypt('user'),
        'affiliate_id'=>str_random(10),
        'referred_by'=>'hB9jh4lfiR'

//        'remember_token' => str_random(10),
    ];
});

$factory->define(App\BankProvider::class, function (Faker\Generator $faker) {
    $data_logo = ['logo-bni.png', 'logo-bca.png', 'logo-bri.png', 'logo-mandiri.png'];
    return [
        'kode' => $faker->countryCode,
        'nama' => $faker->name,
        'logo' => $faker->randomElement($data_logo),
//        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Ulasan::class, function (Faker\Generator $faker) {
    $list_barang = \App\Product::all()->pluck('id')->toArray();
    $rating = [3, 4, 5];
    $list_customer = \App\Customer::all()->pluck('id')->toArray();
    return [
        'id_barang' => $faker->randomElement($list_barang),
        'id_customer' => $faker->randomElement($list_customer),
        'rating'=> $faker->randomElement($rating),
        'deskripsi'=>$faker->paragraphs(3, true)

//        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Diskusi::class, function (Faker\Generator $faker) {
    $list_barang = \App\Product::all()->pluck('id')->toArray();
    $list_customer = \App\Customer::all()->pluck('id')->toArray();
    $list_diskusi = \App\Diskusi::all()->pluck('id')->toArray();
    $user_select = $faker->randomElement($list_barang);
    $list_diskusi = \Illuminate\Support\Facades\DB::table('diskusi')->whereNull('parent')->pluck('id')->toArray();
    return [
        'id_barang' => $faker->randomElement($list_barang),
//        'id_customer' => $faker->randomElement($list_customer),
        'parent' => $faker->randomElement($list_diskusi),
        'deskripsi'=>$faker->paragraphs(3, true)

    ];
});



$factory->define(App\PenarikanSaldo::class, function (Faker\Generator $faker) {
    $affiliate_id = $faker->randomElement(\App\Customer::all()->pluck('affiliate_id')->toArray());

    return [
        'id_affiliate' => $affiliate_id,
        'jumlah' => 50000,
        'status'=>$faker->randomElement(['menunggu', 'selesai'])
    ];
});

$factory->define(App\PencairanSaldo::class, function (Faker\Generator $faker) {
    $affiliate_id = $faker->randomElement(\App\Customer::all()->pluck('affiliate_id')->toArray());

    return [
        'id_penarikan' => factory('App\PenarikanSaldo')->create(),
        'jumlah' => 50000,
        'bukti'=>'/img/not-available.jpg',
        'id_rekening'=>$faker->randomElement(\App\Bank::all()->pluck('id')->toArray())
    ];
});

$factory->define(App\Kategori::class, function (Faker\Generator $faker) {
    return [
        'nama' => $faker->sentence,
        'deskripsi'=>$faker->paragraph(2, true)
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    $kategori = \App\Kategori::all()->pluck('id')->toArray();
    $judul = $faker->sentence;
    $slug = str_slug($judul);
    $media = \App\Media_image::all()->pluck('id')->toArray();
    return [
        'judul' => $judul,
        'slug'=>$slug,
        'body'=>$faker->paragraph(2, true),

        'id_media'=>$faker->randomElement($media),
        'kategori_id'=>$faker->randomElement($kategori)
    ];
});

