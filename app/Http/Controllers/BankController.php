<?php

namespace App\Http\Controllers;

use App\BankProvider;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Setting;
use App\Bank;

class BankController extends Controller
{
    public function index()
    {
    	$pengaturan = Setting::findOrFail(1);
    	$bank  = Bank::all();
    	$list_bank_provider = BankProvider::all();
    	return view('admin.bank', [
    		'pengaturan'	=> $pengaturan,
    		'bank'			=> $bank,
            'bank_provider' => $list_bank_provider
    	]);
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'nama_pemilik'	=> 'required',
    		'no_rekening'	=> 'required',
    		'id_bank'		=> 'required',
    	]);

    	Bank::create($request->all());
    	return redirect('/admin/payment');
    }

    public function destroy($id)
    {
    	Bank::findOrFail($id)->delete();
    	return redirect('/admin/payment');
    }

    public function index_provider()
    {
        $list_bank = BankProvider::all();
        $pengaturan = Setting::findOrFail(1);
        return view('admin.bank.provider', compact(['pengaturan', 'list_bank']));
    }

    public function simpan_bank_provider(Request $request)
    {
        $this->validate($request, [
            'kode'=> 'required|unique:bank_provider',
            'nama'=> 'required',
            'logo'=> 'required|max:10000'
        ]);
        $provider_bank = new BankProvider();

        if($request->get('id')){
            $provider_bank = BankProvider::findOrFail($request->get('id'));
        }


        $file_logo = '';
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = str_random(6) . "." . $file->getClientOriginalExtension();
            $filesize = $file->getClientSize();
            $path = public_path() . '/img';
            $file->move($path, $filename);
            $file_logo = $filename;
        }

        $provider_bank->kode = $request->get('kode');
        $provider_bank->nama = $request->get('nama');
        $provider_bank->logo = $file_logo;

        if($provider_bank->save()){
            return redirect('/admin/bank')->with('sukses', 'Berhasil Menyimpan Data Bank!');
        }

    }

    public function hapus_bank_provider($id, Request $request)
    {
        $provider_bank = BankProvider::findOrFail($id);

        if($provider_bank->delete()){
            return redirect('/admin/bank')->with('sukses', 'Berhasil Menghapus Data Bank!');
        }
    }


}
