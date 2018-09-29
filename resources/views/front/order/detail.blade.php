@extends('layouts.front')

@section('title')
    <title>Order Detail : {{$order->invoice}} | {{ $pengaturan->nama_toko }}</title>
    <meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                        <li class="active">Histori Transaksi</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row" id="content">
            <div class="col-md-3">
                @include('includes.sidebar')
            </div>

            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-info-circle"></i> &nbsp;&nbsp;Informasi Order</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <th>No Invoice</th>
                                        <td>:</td>
                                        <td><strong>#{{$order->invoice}}</strong></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                        <td>:</td>
                                        <td>{{date('d-m-Y', strtotime($order->created_at))}}</td>
                                    </tr>
                                    <tr>
                                        <th>Biaya Kirim</th>
                                        <td>:</td>
                                        <td>Rp. {{number_format($order->jne)}}</td>
                                    </tr>
                                    <tr>
                                        <th>Tujuan Pengiriman</th>
                                        <td>:</td>
                                        <td>{{$order->alamat.', Kabupaten '.$order->city.', Provinsi'.$order->province}}</td>
                                    </tr>
                                </table>

                                <hr>
                                <h3>Detail Pesanan</h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center;">#</th>
                                            <th style="text-align: center; width: 40%">Produk</th>
                                            <th style="text-align: center;">Harga</th>
                                            <th style="text-align: center;">Disc</th>
                                            <th style="text-align: center;">Qty</th>
                                            <th style="text-align: center;">Jumlah</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; ?>
                                        @forelse($order->order_detail as $detail)
                                            <tr>
                                                <td align="center">{{$i}}</td>
                                                <td>( {{$detail->kode_produk}} ) {{$detail->nama_produk}}</td>
                                                <td align="center">Rp. {{number_format($detail->product->harga)}},-</td>
                                                <td align="center">{{number_format($detail->product->diskon)}}%</td>
                                                <td align="center">{{$detail->qty}}</td>
                                                <td align="right">Rp. {{number_format($detail->harga *$detail->qty)}},-</td>
                                            </tr>
                                            <?php $i++ ?>
                                        @empty
                                            <tr>
                                                <td colspan="6" align="center">Tidak Terdapat Data Pembelian</td>
                                            </tr>
                                        @endforelse

                                        @if($order->order_detail()->count() > 0)
                                            <tr>
                                                <td colspan="5" align="right"><strong>Jumlah</strong></td>
                                                <td align="right"><strong>Rp. {{number_format($order->order_detail->sum('harga'))}},-</strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" align="right"><strong>Ongkos Kirim</strong></td>
                                                <td align="right"><strong>Rp. {{number_format($order->jne)}},-</strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" align="right"><strong>Total</strong></td>
                                                <td align="right"><strong>Rp. {{number_format($order->jne+$order->order_detail->sum('harga'))}},-</strong></td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')

@endsection