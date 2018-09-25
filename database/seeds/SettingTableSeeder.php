<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $s = new App\Setting;
        $s->nama_toko = "Pasar E-Rakyat";
        $s->nama_pemilik = "";
        $s->alamat = "Bandung";
        $s->provinsi_id = "12";
        $s->kabupaten_id = "1201";
        $s->sms = "081223596458";
        $s->bbm = "5A567B10";
        $s->line = "parerakyat";
        $s->instagram = "";
        $s->email = "";
        $s->save();
    }
}
