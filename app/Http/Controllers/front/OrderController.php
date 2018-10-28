<?php

namespace App\Http\Controllers\front;

use App\Bank;
use App\Category;
use App\Order;
use App\Product;
use App\Setting;
use App\Testimoni;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
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

        return view('front.order.index', compact(['pengaturan', 'product', 'kategori', 'testimoni', 'bank']));
    }

    public function order_data_aktif(Request $request)
    {
        $customer = auth()->guard('customer')->user();
        $list_order = $customer->order()->where('status_order', '=', 'pending')->orWhere('status_order', '=', 'Proses Pengiriman')->orderBy('created_at', 'desc')->get();
        return view('front.order.aktif', compact(['customer', 'list_order']));
    }

    public function order_data_selesai(Request $request)
    {
        $customer = auth()->guard('customer')->user();
        $list_order = $customer->order()->where('status_order', '=', 'Complete')->orderBy('created_at', 'desc')->get();
        return view('front.order.selesai', compact(['customer', 'list_order']));
    }

    public function order_data_batal(Request $request)
    {
        $customer = auth()->guard('customer')->user();
        $list_order = $customer->order()->where('status_order', '=', 'Batal')->get();
        return view('front.order.batal', compact(['customer', 'list_order']));
    }

    public function order_detail($invoice, Request $request)
    {
        $order = Order::where('invoice', '=', $invoice)->first();
        $pengaturan = Setting::find(1);
        $product = Product::orderBy('created_at', 'desc')->with('media_image', 'category')->take(8)->paginate(8);
        $kategori = Category::all();
        $testimoni = Testimoni::where('status', '=', 1)->orderBy('created_at', 'desc')->take(10)->get();
        $bank = Bank::all();
        return view('front.order.detail', compact(['order', 'pengaturan', 'product', 'kategori', 'testimoni', 'bank']));
    }


}
