<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Setting;
use App\Page;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PageController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('auth:admin');
    }

    public function index()
    {
    	$pengaturan = Setting::findOrFail(1);
    	$page = Page::all();
    	return view('admin.page.index', [
    		'pengaturan'	=> $pengaturan,
    		'page'			=> $page
    	]);
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
            'pengaturan'    => $pengaturan,
            'page'          => $page,
            'kategori'      => $kategori,
            'testimoni'     => $testimoni,
            'bank'          => $bank
        ]);
    }

    public function create()
    {
    	$pengaturan = Setting::findOrFail(1);
    	return view('admin.page.create', [
    		'pengaturan'	=> $pengaturan
    	]);
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'judul'	=> 'required|max:20',
    		'slug'	=> 'bail|required|unique:pages',
    		'content'	=> 'required'
    	]);

        $content = $request->content;
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
        $page = new Page();

        if($request->get('id')){
            $page = Page::findOrFail($request->get('id'));
        }

        $page->judul = $request->get('judul');
        $page->slug = $request->get('slug');
        $page->content = $content;

    	if($page->save()){
            return redirect('/admin/pages')->with('sukses', 'Berhasil Menyimpan Page');
        }

    }

    public function edit($id)
    {
    	$pengaturan = Setting::findOrFail(1);
    	$page = Page::findOrFail($id);
    	return view('admin.page.edit', [
    		'pengaturan'	=> $pengaturan,
    		'page'			=> $page
    	]);
    }

    public function update(Request $request, $id)
    {
        $content = $request->content;
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
        $page = new Page();

        if($request->get('id')){
            $page = Page::findOrFail($request->get('id'));
        }

        $page->judul = $request->get('judul');
        $page->slug = $request->get('slug');
        $page->content = $content;

        if($page->save()){
            return redirect('/admin/pages')->with('sukses', 'Berhasil Menyimpan Page');
        }
    }

    public function destroy($id)
    {
    	Page::findOrFail($id)->delete();
    	return redirect('/admin/pages');
    }
}
