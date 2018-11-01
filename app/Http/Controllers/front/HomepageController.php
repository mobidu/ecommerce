<?php

namespace App\Http\Controllers\front;

use App\Diskusi;
use App\Post;
use App\Slide;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Setting;
use App\Product;
use App\Category;
use App\Supplier;
use Cart;
use Illuminate\Support\Facades\Storage;
use Response;
use RajaOngkir;
use App\Order;
use App\Bank;
use App\Paid;
use App\Testimoni;
use App\Page;

class HomepageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:customer', ['except'=>[
            'index', 'cart', 'proses_cart', 'delete_cart', 'kategori', 'show',
            'checkout', 'update_cart', 'getCity', 'ongkir', 'ConfirmPembayaran', 'cekInvoice',
            'simpanInvoice', 'frontPage', 'tentang', 'detile_blog', 'blog'
        ]]);
    }

    public function index()
    {
        $pengaturan = Setting::find(1);
        $product = Product::orderBy('created_at', 'desc')->with('media_image', 'category')->take(8)->paginate(8);
        $kategori = Category::all();
        $list_slide = Slide::limit(4)->get();
        $testimoni = Testimoni::where('status', '=', 1)->orderBy('created_at', 'desc')->take(10)->get();
        $list_post = Post::limit(10)->get();
        $bank = Bank::all();
        return view('front.index', [
            'pengaturan'    => $pengaturan,
            'product'       => $product,
            'kategori'      => $kategori,
            'testimoni'     => $testimoni,
            'bank'          => $bank,
            'list_slide'    => $list_slide,
            'list_post'     => $list_post
            ]);
    }

    public function cart(Request $request)
    {
        $cart = Cart::content();
        $total = Cart::total();
        $pengaturan = Setting::find(1);
        
        return view('front.cart', array(
                    'cart'          => $cart, 
                    'pengaturan'    => $pengaturan,
                    'total'         => $total
                ));
    }

    public function proses_cart(Request $request)
    {
        $kode_produk = $request->get('kode_produk');
        $product = Product::where('kode_produk', '=', $kode_produk)->with('media_image','supplier')->first();
        $name_photo = $product->media_image_id != null ? $product->media_image->name_photo : "";
        $ref = '';
        if($request->has('ref')){
            $ref = $request->get('ref');
        }
        $data_cart = array(
            'id'        => $kode_produk,
            'name'      => $product->nama_produk,
            'qty'       => 1,
            'price'     => $product->harga_jual,
            'options'   => array (
                'berat'         => $product->berat,
                'name_photo'    => $name_photo,
                'totalberat'    => 0
            )
        );
        if($ref){
            array_push($data_cart, ['ref'=>$ref]);
        }
            Cart::add($data_cart);
        $cart = Cart::content();
        $nama_produk = $product->nama_produk;
        return response()->json([
                        'cart' => $nama_produk
                        ]);
    }

    public function delete_cart(Request $request) 
    {
        if ($request->get('kode_produk')) {
            $rowId = Cart::search(array('id' => $request->get('kode_produk')));
            Cart::remove($rowId[0]);
        } else {
            return redirect('/');
        }

        return redirect('/cart');
    }


    public function kategori($slug) 
    {
        $data_slug_kategori = Category::where('slug', '=', $slug)->first();
        $pengaturan = Setting::find(1);
        $product = Product::where('kategori_id', '=', $data_slug_kategori->id)->orderBy('created_at', 'desc')->with('media_image', 'category')->paginate(8);
        $kategori = Category::all();
        $testimoni = Testimoni::where('status', '=', 1)->orderBy('created_at', 'desc')->take(10)->get();
        $bank = Bank::all();

        return view('front.kategori', [
            'pengaturan'    => $pengaturan,
            'product'       => $product,
            'kategori'      => $kategori,
            'head'          => $data_slug_kategori,
            'testimoni'     => $testimoni,
            'bank'          => $bank
            ]);
    }
    
    public function show($id)
    {
        $pengaturan = Setting::find(1);
        $product = Product::where('slug', '=', $id)->with('media_image', 'category')->first();
        $kategori = Category::all();
        $stars = [
            '1'=>$product->ulasan()->where('rating', '=', 1)->count(),
            '2'=>$product->ulasan()->where('rating', '=', 2)->count(),
            '3'=>$product->ulasan()->where('rating', '=', 3)->count(),
            '4'=>$product->ulasan()->where('rating', '=', 4)->count(),
            '5'=>$product->ulasan()->where('rating', '=', 5)->count()
        ];

//        dd($stars);
        $testimoni = Testimoni::where('status', '=', 1)->orderBy('created_at', 'desc')->take(10)->get();
        $bank = Bank::all();
        return view('front.produk', [
            'pengaturan'    => $pengaturan,
            'product'       => $product,
            'kategori'      => $kategori,
            'testimoni'     => $testimoni,
            'bank'          => $bank,
            'stars'         => $stars
            ]);
    }

    public function checkout()
    {
        $provinsi = RajaOngkir::Provinsi()->all();

        $pengaturan = Setting::find(1);
        $cart = Cart::content();
        $total = Cart::total();
        return view('front.checkout', [
            'provinsi'      => $provinsi,
            'pengaturan'    => $pengaturan,
            'cart'          => $cart,
            'total'         => $total
            ]);
    }

    public function update_cart(Request $request)
    {
        $cart = Cart::content();
        foreach ($cart as $item) {
            $data[] = ['rowid' => $item->rowid, 'qty' => $item->qty, 'berat' => $item->options->berat];
            
        }
        for ($i=0; $i<count($data); $i++) {
            $beratakhir[] = $data[$i]['qty'] * $data[$i]['berat'] ;
        }
        
        $total = array_sum($beratakhir);
        for ($i=0; $i<count($data); $i++) {
            Cart::update($data[$i]['rowid'], array('options' => array('totalberat' => $total)));
        }
        return redirect('/checkout');
    }

    public function getCity(Request $request)
    {
        $kota = RajaOngkir::Kota()->byProvinsi($request->province)->get();
        
        for ($i=0; $i<count($kota); $i++) {
            $data[] = ['id' => $kota[$i]['city_id'],
                      'city_name' => $kota[$i]['city_name']
                    ];
        }
        return Response::json($data);
    }

    public function ongkir(Request $request)
    {

        $kota_asal = Setting::first();

        $data = RajaOngkir::Cost([
            'origin'        => $kota_asal->kabupaten_id,
            'destination'   => $request->destination, 
            'weight'        => $request->weight, 
            'courier'       => 'jne', 
        ])->get();

        for ($i=0; $i<count($data[0]['costs']); $i++)
        {
            $hitung[] = ['service' => $data[0]['costs'][$i]['service'],
                        'description' => $data[0]['costs'][$i]['description'],
                        'biaya'  => $data[0]['costs'][$i]['cost'][0]['value'],
                        'etd'   => $data[0]['costs'][$i]['cost'][0]['etd']
            ];
        }
        return Response::json($hitung);
    }

    public function ConfirmPembayaran()
    {
        $pengaturan = Setting::findOrFail(1);
        $kategori = Category::all();
        $bank = Bank::all();
        $testimoni = Testimoni::where('status', '=', 1)->orderBy('created_at', 'desc')->take(10)->get();
        return view('front.pembayaran', [
            'pengaturan'    => $pengaturan,
            'kategori'      => $kategori,
            'bank'          => $bank,
            'testimoni'     => $testimoni,
            'bank'          => $bank
        ]);
    }

    public function cekInvoice(Request $request)
    {
        $invoice = $request->input('invoice');
        $dataInvoice = Order::where('invoice', '=', $invoice)->first();
        $pesan = $dataInvoice == "" ? '0':'1';
        return response()->json([
                'pesan'=>$pesan
                ]);
    }

    public function simpanInvoice(Request $request)
    {
        $this->validate($request, [
            'invoice'       => 'bail|required|unique:paids',
            'nama_pemilik'  => 'required',
            'bank_from'     => 'required',
            'no_rekening'   => 'required',
            'bank_to'       => 'required',
            'jumlah'        => 'required',
            'bukti_transfer'=> 'required'
        ]);

        $fullUrl = '';

        if ($request->hasFile('bukti_transfer')) {
            $file = $request->file('bukti_transfer');
            $filename = str_random(6) . "." . $file->getClientOriginalExtension();
            $path = public_path() . '/upload/bukti';
            $fullUrl = $request->file('bukti_transfer')->storeAs(
                '/public/upload/bukti', $filename
            );;
        }

        $paid = new Paid();
        $paid->invoice = $request->get('invoice');
        $paid->nama_pemilik = $request->get('nama_pemilik');
        $paid->bank_from = $request->get('bank_from');
        $paid->no_rekening = $request->get('no_rekening');
        $paid->bank_to = $request->get('bank_to');
        $paid->jumlah = $request->get('jumlah');
        $paid->bukti_transfer = $fullUrl;

        $paid->save();

//        if (!empty($paid->id)) {
//            $order = Order::where('invoice', '=', $paid->invoice)->first();
//            $order->update(['paid_id' => $paid->id]);
//        }

        return redirect('/konfirmasi-pembayaran')->with('status', 'Konfirmasi Pembayaran Sukses');
    }

    public function frontPage($slug)
    {
        $pengaturan = Setting::findOrFail(1);
        $kategori = Category::all();
        $testimoni = Testimoni::where('status', '=', 1)->orderBy('created_at', 'desc')->take(10)->get();
        $bank = Bank::all();
        $page = Page::where('slug', '=', $slug)->first();

        return view('front.page', [
            'pengaturan'    => $pengaturan,
            'page'          => $page,
            'kategori'      => $kategori,
            'testimoni'     => $testimoni,
            'bank'          => $bank
        ]);
    }

    public function tentang()
    {
        $pengaturan = Setting::findOrFail(1);
        $kategori = Category::all();
        $testimoni = Testimoni::where('status', '=', 1)->orderBy('created_at', 'desc')->take(10)->get();
        $bank = Bank::all();

        return view('front.tentang', compact(['pengaturan', 'kategori', 'testimoni', 'bank']));
    }

    public function simpan_diskusi($id_barang, Request $request)
    {
        $this->validate($request, [
            'komentar'=> 'required|min:5'
        ]);

        $diskusi = new Diskusi();
        $diskusi->deskripsi = $request->get('komentar');
        $diskusi->id_barang = $id_barang;
        $diskusi->id_customer = auth()->guard('customer')->user()->id;
        if($diskusi->save()){
            return redirect()->back()->with('sukses', 'Berhasil Menambahkan Diskusi!');
        }
    }

    public function detile_blog($slug, Request $request){
        $post = Post::where('slug', '=', $slug)->first();
        $pengaturan = Setting::findOrFail(1);
        $kategori = Category::all();
        $testimoni = Testimoni::where('status', '=', 1)->orderBy('created_at', 'desc')->take(10)->get();
        $bank = Bank::all();
        return view('front.blog_detile', compact(['pengaturan', 'kategori', 'testimoni', 'bank', 'post']));
    }

    public function blog()
    {
        $post = Post::paginate(10);
        $pengaturan = Setting::findOrFail(1);
        $kategori = Category::all();
        $testimoni = Testimoni::where('status', '=', 1)->orderBy('created_at', 'desc')->take(10)->get();
        $bank = Bank::all();
        return view('front.blog', compact(['pengaturan', 'kategori', 'testimoni', 'bank', 'post']));
    }
    
}
