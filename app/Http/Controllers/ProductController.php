<?php

namespace App\Http\Controllers;

use App\Diskusi;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Setting;
use App\Product;
use App\Category;
use App\Supplier;
use App\Media_image;
use File;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $pengaturan = Setting::find(1);
        $product    = Product::with('media_image','category')->get();

        return view('admin.product.index', [
            'pengaturan'    => $pengaturan,
            'product'       => $product
            ]);
    }

    public function getSlug(Request $request)
    {
        $nama_produk = str_slug($request->input('nama_produk'));
        $dataslug = Product::where('slug', $nama_produk)->first();
        $pesan = $dataslug == "" ? '0':'1';
        return response()->json([
                'nama_produk'=>$nama_produk,
                'pesan'=>$pesan
                ]);
    }

    public function getKode(Request $request)
    {
        $kode_produk = $request->input('nama_produk');
        $datakode = Product::where('kode_produk', $kode_produk)->first();
        $pesan = $datakode == "" ? '0':'1';
        return response()->json([
                'pesan'=>$pesan
                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pengaturan = Setting::find(1);
        $kategori = Category::all();
        $supplier = Supplier::all();
        return view('admin.product.create', [
            'pengaturan'    => $pengaturan,
            'kategori'      => $kategori,
            'supplier'      => $supplier
            ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_produk'   => 'required',
            'slug'          => 'bail|required|unique:products',
            'kode_produk'   => 'bail|required|unique:products',
            'kategori_id'   => 'required',
            'supplier_id'   => 'required',
            'publish'       => 'required|boolean',
            'harga'         => 'required|integer',
            'diskon'        => 'required|integer',
            'hemat'         => 'required|integer',
            'harga_jual'    => 'required|integer',
            'berat'         => 'required|integer',
            'stok'          => 'required|integer',
            'media_image_id'=> 'image|max:2048'
            ]);
        $hemat = $request->harga * $request->diskon / 100;
        $harga_jual = $request->harga - $hemat;
        
        if (!$request->hasFile('media_image_id')) {
            $lastInsertId = null;
        } else {
            $photo = $request->file('media_image_id');
            $filename = str_random(6) . "." . $photo->getClientOriginalExtension();
            $filesize = $photo->getClientSize();
            $path = public_path() . '/upload/img';
            $photo->move($path, $filename);

            $media = Media_image::create([
                'name_photo'    => $filename,
                'size_photo'    => $filesize
                ]);

            $lastInsertId = $media->id;
        }

        $content = $request->get('deskripsi');
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
                $filename = Auth::guard('admin')->Id().'_'.md5(time().$k.Auth::guard('admin')->Id());
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

        Product::create([
            'kode_produk'   => $request->kode_produk,
            'nama_produk'   => $request->nama_produk,
            'slug'          => $request->slug,
            'kategori_id'   => $request->kategori_id,
            'supplier_id'   => $request->supplier_id,
            'deskripsi'     => $content,
            'berat'         => $request->berat,
            'stok'          => $request->stok,
            'media_image_id'=> $lastInsertId,
            'publish'       => $request->publish,
            'harga'         => $request->harga,
            'komisi'         => $request->komisi,
            'diskon'        => $request->diskon,
            'harga_jual'    => $harga_jual,
            ]);
        return redirect('/admin/product');
    }

    public function hapusGambar(Request $request)
    {
        $gambar = $request->input('media_image_id');
        $data_id = $request->input('data_id');
        $product = Product::find($data_id);
        
        if ($product->update(['media_image_id'=>null])) {
            $media_image = Media_image::find($gambar);
            File::delete('upload/img/' . $media_image->name_photo);
            $media_image->delete();
            $success = 1;
        }

        return response()->json([
                'update_media'=>$success
                ]);
    }

    public function edit($id)
    {
        $pengaturan = Setting::find(1);
        $kategori = Category::all();
        $supplier = Supplier::all();
        $product = Product::find($id);
        return view('admin.product.edit', [
            'pengaturan'    => $pengaturan,
            'kategori'      => $kategori,
            'supplier'      => $supplier,
            'product'       => $product
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_produk'   => 'required',
            'kategori_id'   => 'required',
            'supplier_id'   => 'required',
            'publish'       => 'required|boolean',
            'harga'         => 'required|integer',
            'diskon'        => 'required|integer',
            'hemat'         => 'required|integer',
            'harga_jual'    => 'required|integer',
            'berat'         => 'required|integer',
            'stok'          => 'required|integer',
            'media_image_id'=> 'image|max:2048'
            ]);
        $hemat = $request->harga * $request->diskon / 100;
        $harga_jual = $request->harga - $hemat;
        $update_data = Product::find($id);
        if (!$request->hasFile('media_image_id')) {
            $lastInsertId = $update_data->media_image_id;
        } else {
            $photo = $request->file('media_image_id');
            $filename = str_random(6) . "." . $photo->getClientOriginalExtension();
            $filesize = $photo->getClientSize();
            $path = public_path() . '/upload/img';
            $photo->move($path, $filename);

            $media = Media_image::create([
                'name_photo'    => $filename,
                'size_photo'    => $filesize
                ]);
            $lastInsertId = $media->id;
        }

        $content = $request->get('deskripsi');
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
                $filename = Auth::guard('admin')->Id().'_'.md5(time().$k.Auth::guard('admin')->Id());
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

        $update_data->update([
            'nama_produk'   => $request->nama_produk,
            'kategori_id'   => $request->kategori_id,
            'supplier_id'   => $request->supplier_id,
            'deskripsi'     => $content,
            'berat'         => $request->berat,
            'stok'          => $request->stok,
            'media_image_id'=> $lastInsertId,
            'komisi'         => $request->komisi,
            'publish'       => $request->publish,
            'harga'         => $request->harga,
            'diskon'        => $request->diskon,
            'harga_jual'    => $harga_jual,
            ]);
        return redirect('/admin/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product->media_image_id != null) {
            $media_image = Media_image::find($product->media_image_id);
            File::delete('upload/img/' . $media_image->name_photo);
            $product->update(['media_image_id'=>null]);
            $media_image->delete();
        } 

        $product->delete();
        return redirect('/admin/product');
    }

    public function uploadImage(Request $request)
    {
        return $request->all();
    }

    public function simpan_balasan_diskusi($id_barang, $id_parent, Request $request)
    {

        $this->validate($request, [
            'komentar'=>'required|min:5'
        ]);

        $diskusi = new Diskusi();
        $diskusi->parent = $id_parent;
        $diskusi->id_barang = $id_barang;
        $diskusi->deskripsi = $request->get('komentar');

        if($diskusi->save()){
            return redirect()->back()->with('sukses', 'Berhasil Menambalas Komentar');
        }


    }
}
