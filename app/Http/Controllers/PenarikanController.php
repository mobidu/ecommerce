<?php

namespace App\Http\Controllers;

use App\Bank;
use App\PenarikanSaldo;
use App\PencairanSaldo;
use App\Setting;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class PenarikanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $pengaturan = Setting::findOrFail(1);
        return view('admin.penarikan.index', compact(['pengaturan']));
    }

    public function data()
    {

        $pembayaran = PenarikanSaldo::select(['id','id_affiliate','no_rek','nama_pemilik','jumlah', 'status', 'created_at'])->orderBy('created_at', 'desc');

        return Datatables::of($pembayaran)->addColumn('waktu', function ($pembayaran) {
            return $pembayaran->created_at->diffForHumans();
        })->addColumn('action', function ($pembayaran) {
            if($pembayaran->status == 'menunggu'){
                return '<a href="/admin/request_penarikan/konfirmasi/'.$pembayaran->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-file"></i>&nbsp;&nbsp;Konfirmasi</a>';
            }else{
                return '<a href="/admin/request_penarikan/konfirmasi/'.$pembayaran->id.'/detail" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-file"></i>&nbsp;&nbsp;Detail</a>';
            }

        })->addColumn('status_order', function($pembayaran){
            $res = '';
            if($pembayaran->status === 'menunggu'){
                $res .= '<i class="label label-warning">Menunggu</i>';
            }else if($pembayaran->status == 'selesai'){
                $res .= '<i class="label label-success">Selesai</i>';
            }

            return $res;
        })->make(true);
    }

    public function konfirmasi($id, Request $request)
    {
        $request_penarikan = PenarikanSaldo::findOrFail($id);
        $pengaturan = Setting::findOrFail(1);
        $bank = Bank::all();
        return view('admin.penarikan.konfirmasi', compact(['request_penarikan', 'pengaturan', 'bank']));
    }

    public function konfirmasi_pembayaran(Request $request)
    {
        $this->validate($request, [
            'jumlah'=>'required',
            'bukti'=>'required|file',
            'bank'=>'required'
        ]);

        $penarikan = PenarikanSaldo::findOrFail($request->get('id_penarikan'));
//        dd($penarikan);
        $pencairan = new PencairanSaldo();
        $pencairan->jumlah = $request->get('jumlah');
        $pencairan->id_penarikan = $request->get('id_penarikan');
        $pencairan->id_rekening = $request->get('bank');
        $foto = '';
        if ($request->hasFile('bukti')) {

            $photo = $request->file('bukti');
            $filename = str_random(6) . "." . $photo->getClientOriginalExtension();
            $filesize = $photo->getClientSize();
            $path = public_path() . '/upload/img';
            $photo->move($path, $filename);


            $foto= '/upload/img'.$filename;
        }

        $pencairan->bukti = $foto;

        if($pencairan->save()){
            $penarikan->status = 'selesai';

            if($penarikan->save()){
                $customer = $penarikan->customer;
                $customer->saldo = $customer->saldo - $penarikan->jumlah;
                $customer->save();
            }
            return redirect('/admin/request_penarikan')->with('sukses', "Berhasil Konfirmasi Pembayaran");
        }
    }

}
