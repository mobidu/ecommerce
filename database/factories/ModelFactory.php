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

