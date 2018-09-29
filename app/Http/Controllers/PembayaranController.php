<?php

namespace App\Http\Controllers;

use App\Events\OrderShipment;
use App\Order;
use App\Paid;
use App\Setting;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

//use Yajra\Datatables\Facades\Datatables;

class PembayaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $pengaturan = Setting::first();
        return view('admin.pembayaran.index', compact('pengaturan'));
    }

    public function data()
    {
        $pembayaran = Paid::select(['id','invoice','nama_pemilik','bank_from', 'no_rekening', 'bank_to', 'jumlah', 'status', 'created_at'])->orderBy('created_at', 'desc');

        return Datatables::of($pembayaran)->addColumn('waktu', function ($pembayaran) {
                return $pembayaran->created_at->diffForHumans();
            })->addColumn('action', function ($pembayaran) {
            return '<a href="/admin/pembayaran/'.$pembayaran->invoice.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-file"></i> Detail</a>';
        })->addColumn('status_order', function($pembayaran){
            $res = '';
            if($pembayaran->status === 'menunggu'){
                $res .= '<i class="label label-warning">Menunggu</i>';
            }else if($pembayaran->status === 'konfirmasi'){
                $res .= '<i class="label label-success">Konfirmasi</i>';
            }else if($pembayaran->status == 'tolak'){
                $res .= '<i class="label label-danger">Ditolak</i>';
            }

            return $res;
        })->make(true);
    }

    public function detile($invoice, Request $request)
    {
        $data = Paid::where('invoice', '=', $invoice)->first();
        $pengaturan = Setting::first();

        if(!$data)
        {
            abort(404);
        }

        return view('admin.pembayaran.detile', compact(['data', 'pengaturan']));
    }

    public function konfirmasi($invoice)
    {
        $paid = Paid::where('invoice','=', $invoice)->first();
        $order = Order::where('invoice', '=', $paid->invoice)->first();
        $paid->status = 'konfirmasi';
        event(new OrderShipment($order));
        if($order->update(['paid_id' => $paid->id]) && $paid->save()){
            return redirect('/admin/pembayaran')->with('sukses', "Pembayaran berhasil di konfirmasi!");
        }
    }
}
