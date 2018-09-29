@extends('layouts.front')

@section('title')
    <title>Order Detail : {{$order->invoice}} | {{ $pengaturan->nama_toko }}</title>
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <style>
        @media print {

            [class*="col-sm-"] {
                float: left;
            }

            [class*="col-xs-"] {
                float: left;
            }

            .col-sm-12, .col-xs-12 {
                width:100% !important;
            }

            .col-sm-11, .col-xs-11 {
                width:91.66666667% !important;
            }

            .col-sm-10, .col-xs-10 {
                width:83.33333333% !important;
            }

            .col-sm-9, .col-xs-9 {
                width:75% !important;
            }

            .col-sm-8, .col-xs-8 {
                width:66.66666667% !important;
            }

            .col-sm-7, .col-xs-7 {
                width:58.33333333% !important;
            }

            .col-sm-6, .col-xs-6 {
                width:50% !important;
            }

            .col-sm-5, .col-xs-5 {
                width:41.66666667% !important;
            }

            .col-sm-4, .col-xs-4 {
                width:33.33333333% !important;
            }

            .col-sm-3, .col-xs-3 {
                width:25% !important;
            }

            .col-sm-2, .col-xs-2 {
                width:16.66666667% !important;
            }

            .col-sm-1, .col-xs-1 {
                width:8.33333333% !important;
            }

            .col-sm-1,
            .col-sm-2,
            .col-sm-3,
            .col-sm-4,
            .col-sm-5,
            .col-sm-6,
            .col-sm-7,
            .col-sm-8,
            .col-sm-9,
            .col-sm-10,
            .col-sm-11,
            .col-sm-12,
            .col-xs-1,
            .col-xs-2,
            .col-xs-3,
            .col-xs-4,
            .col-xs-5,
            .col-xs-6,
            .col-xs-7,
            .col-xs-8,
            .col-xs-9,
            .col-xs-10,
            .col-xs-11,
            .col-xs-12 {
                float: left !important;
            }

            body {
                margin: 0;
                padding: 0 !important;
                min-width: 768px;
            }

            .container {
                width: auto;
                min-width: 750px;
            }

            body {
                font-size: 10px;
            }

            a[href]:after {
                content: none;
            }

            .noprint,
            div.alert,
            header,
            .group-media,
            .btn,
            .footer,
            form,
            #comments,
            .nav,
            ul.links.list-inline,
            ul.action-links {
                display:none !important;
            }
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row hidden-print">
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
            <div class="col-md-3 hidden-print">
                @include('includes.sidebar')
            </div>

            <div class="col-md-9 col-sm-12 col-xs-12">
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
                        <hr>
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


@endsection

@section('script')

@endsection