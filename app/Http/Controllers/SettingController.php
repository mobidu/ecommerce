<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Setting;
use App\Provinsi;
use App\Kabupaten;
use Response;

class SettingController extends Controller
{
    
    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $pengaturan = Setting::find(1);
//        $provinsi = new RajaOngkir();
        $provinsi = \RajaOngkir::provinsi()->all();
        $kabupaten = \RajaOngkir::kota()->find($pengaturan->kabupaten_id);
//        dd($kabupaten);
        return view('admin.setting', [
            'pengaturan'    =>$pengaturan,
            'provinsi'      =>$provinsi,
            'kabupaten'     =>$kabupaten
            ]);
    }

    public function getKabupaten(Request $request)
    {

        $provinsi_id = $request->id;
        $kabupaten = \RajaOngkir::kota()->byProvinsi($provinsi_id)->get();
//        foreach ($kabupaten as $kabupaten) {
//            $a[] = array(
//                'id'=>$kabupaten->id,
//                'nama_kabupaten'=>$kabupaten->nama_kabupaten
//                );
//        }
        return response()->json($kabupaten, 200);
    }

    public function update(Request $request)
    {
        $setting = Setting::find(1);
        $setting->update($request->all());
        return redirect('/admin/setting');
    }

}
