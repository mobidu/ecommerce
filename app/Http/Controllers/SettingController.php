<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Setting;
use App\Provinsi;
use App\Kabupaten;
use Illuminate\Support\Facades\Auth;
use Response;
use Image;

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
//        $setting->update($request->all());
        $content = $request->deskripsi_lengkap;
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml('<?xml encoding="utf-8" ?>'.$content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        $gambar = [];

        foreach($images as $k => $img){
            $data = $img->getAttribute('src');
            if(preg_match('/data:image/', $data)){
                // get the mimetype
                preg_match('/data:image\/(?<mime>.*?)\;/', $data, $groups);
                $mimetype = $groups['mime'];
                // Generating a random filename
                $filename = Auth::Id().'_'.md5(time().$k.Auth()->Id());
                $filepath = "/img/$filename.$mimetype";
                // @see http://image.intervention.io/api/
                $image = Image::make($data)
                    // resize if required
                    /* ->resize(300, 200) */
                    ->encode($mimetype, 100)  // encode file to the specified mimetype
                    ->save(public_path($filepath),50);

                array_push($gambar, $filepath);

                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            } // <!--endif
        }
        $content = $dom->saveHTML();

        $setting->nama_toko = $request->get('nama_toko');
        $setting->nama_pemilik = $request->get('nama_pemilik');
        $setting->alamat = $request->get('alamat');
        $setting->provinsi_id = $request->get('provinsi_id');
        $setting->kabupaten_id = $request->get('kabupaten_id');
        $setting->sms = $request->get('sms');
        $setting->bbm = $request->get('bbm');
        $setting->line = $request->get('line');
        $setting->instagram = $request->get('instagram');
        $setting->email = $request->get('email');
        $setting->map = $request->get('map');
        $setting->deskripsi_lengkap = $content;

        $filename = '';
        if($request->hasFile('banner_toko')){
            $photo = $request->file('banner_toko');
            $filename = str_random(6) . "." . $photo->getClientOriginalExtension();
            $filesize = $photo->getClientSize();
            $path = public_path() . '/img';
            $photo->move($path, $filename);
        }
        if($filename){
            $setting->banner_toko = $filename;
        }


        if($setting->save())
        {
            return redirect('/admin/setting')->with('sukses', 'Berhasil Merubah Data Toko');
        }





    }

}
