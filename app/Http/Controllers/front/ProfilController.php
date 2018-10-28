<?php

namespace App\Http\Controllers\front;

use App\Bank;
use App\Category;
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

    public function update_profil()
    {

    }

}
