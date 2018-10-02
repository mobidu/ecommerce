<?php

use Illuminate\Database\Seeder;

class GenerateDefaultPage extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Page::create([
            'judul'=>'Cara Belanja',
            'slug'=>'cara-belanja',
            'content'=>'<p>Cara Belanja</p>'
        ]);
        \App\Page::create([
            'judul'=>'Metode Pembayaran',
            'slug'=>'metode-pembayaran',
            'content'=>'<p>Metode Pembayaran</p>'
        ]);
    }
}
