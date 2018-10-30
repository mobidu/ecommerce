<?php

namespace App\Http\Controllers\front;

use App\Bank;
use App\Category;
use App\Customer;
use App\PenarikanSaldo;
use App\Product;
use App\Setting;
use App\Testimoni;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:customer');
    }

    public function index()
    {
        $pengaturan = Setting::find(1);
        $product = Product::orderBy('created_at', 'desc')->with('media_image', 'category')->take(8)->paginate(8);
        $kategori = Category::all();
        $testimoni = Testimoni::where('status', '=', 1)->orderBy('created_at', 'desc')->take(10)->get();
        $bank = Bank::all();
//        $user = auth()->guard('customer')->user()->nama_lengkap;
//        dd($user);
        return view('front.customer.index', compact(['pengaturan', 'product', 'kategori', 'testimoni', 'bank']));
    }

    public function affiliate(){
        $pengaturan = Setting::find(1);
        $product = Product::orderBy('created_at', 'desc')->with('media_image', 'category')->take(8)->paginate(8);
        $kategori = Category::all();
        $testimoni = Testimoni::where('status', '=', 1)->orderBy('created_at', 'desc')->take(10)->get();
        $bank = Bank::all();
        return view('front.customer.affiliate', compact(['pengaturan', 'product', 'kategori', 'testimoni', 'bank']));
    }

    public function penarikan_saldo()
    {
        $pengaturan = Setting::find(1);
        $product = Product::orderBy('created_at', 'desc')->with('media_image', 'category')->take(8)->paginate(8);
        $kategori = Category::all();
        $testimoni = Testimoni::where('status', '=', 1)->orderBy('created_at', 'desc')->take(10)->get();
        $bank = Bank::all();

        return view('front.customer.penarikan', compact(['pengaturan', 'product', 'kategori', 'testimoni', 'bank']));
    }

    public function simpan_penarikan_saldo(Request $request)
    {
        $this->validate($request, [
            'no_rekening'=>'required',
            'nama_pemilik'=>'required',
            'jumlah'=>'required'
        ]);

        $penarikan = new PenarikanSaldo();
        $penarikan->no_rek = $request->get('no_rekening');
        $penarikan->id_affiliate = $request->get('id_affiliate');
        $penarikan->nama_pemilik = $request->get('nama_pemilik');
        $penarikan->jumlah = $request->get('jumlah');
        $penarikan->status = 'menunggu';

        if($penarikan->save()){
            return redirect()->back()->with('sukses', "Pengajuan Pencairan Saldo Berhasil Diajukan, Mohon tunggu Konfirmasi email dari kami untuk status pengajuan");
        }
    }

}
