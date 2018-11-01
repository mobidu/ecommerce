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
                @if(session()->has('sukses'))
                    <div class="alert allert-success">
                        <p>{{session()->get('sukses')}}</p>
                    </div>
                @endif
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
                            <tr>
                                <th>Status</th>
                                <td>:</td>
                                <td>
                                    <?php
                                        switch ($order->status_order){
                                            case "Pending" :
                                                echo "<span class='label label-danger'>Menunggu Proses Pembayaran</span>";
                                                break;
                                            case "Proses Pengiriman" :
                                                echo "<span class='label label-info'>Proses Pengiriman</span>";
                                                break;
                                            case "Complete" :
                                                echo '<span class="label label-success">Selesai</span>';
                                                break;
                                            case "Batal" :
                                                echo '<span class="label label-danger">Batal</span>';
                                                break;
                                            default :
                                                echo '<span class="label label-danger">Error</span>';
                                        }
                                    ?>
                                </td>
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
                        @if($order->status_order == 'Complete')
                            <br />
                            <br />
                            <h3>Rating Barang</h3>
                            <hr />
                            @forelse($order->order_detail as $detail)
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-2 col-xs-4">
                                                <img src="{{asset('upload/img/' . $detail->product->media_image->name_photo)}}" alt="" width="100%">
                                            </div>
                                            <div class="col-md-10 col-xs-8">
                                                <h5>{{'('.$detail->product->kode_produk.') '.$detail->product->nama_produk}}</h5>
                                                <p>
                                                    Jumlah : {{$detail->qty}}
                                                </p>
                                                <p>
                                                    Harga : Rp. {{number_format($detail->harga)}},-
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @if($detail->product->ulasan()->where('id_order', '=', $order->id)->count() < 1)

                                                    <form action="{{url('/order/detail/'.$order->invoice.'/ulasan/'.$detail->product->id)}}" method="post">
                                                        {{csrf_field()}}
                                                        <div class="form-group" id="rating-ability-wrapper">
                                                            <input type="hidden" id="selected_rating" name="rating" required="required">
                                                            <h4 class="bold rating-header" style="">
                                                                <span class="selected-rating">0</span><small> / 5</small>
                                                            </h4>
                                                            <button type="button" class="btnrating btn btn-default btn-xs" data-attr="1" id="rating-star-1">
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                            </button>
                                                            <button type="button" class="btnrating btn btn-default btn-xs" data-attr="2" id="rating-star-2">
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                            </button>
                                                            <button type="button" class="btnrating btn btn-default btn-xs" data-attr="3" id="rating-star-3">
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                            </button>
                                                            <button type="button" class="btnrating btn btn-default btn-xs" data-attr="4" id="rating-star-4">
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                            </button>
                                                            <button type="button" class="btnrating btn btn-default btn-xs" data-attr="5" id="rating-star-5">
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea name="ulasan" class="form-control" rows="4" placeholder="Masukan Ulasan Terhadap Produk"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <button class="btn btn-primary pull-right">Submit Ulasan</button>
                                                        </div>
                                                    </form>
                                                @else
                                                    <?php
                                                        $ulasan = $detail->product->ulasan()->where('id_order', '=', $order->id)->first();
                                                        $banyak = 5;
                                                        ?>
                                                    <div class="form-group" id="rating-ability-wrapper">
                                                        <input type="hidden" id="selected_rating" name="rating" required="required">
                                                        <h4 class="bold rating-header" style="">
                                                            <span class="selected-rating">{{$ulasan->rating}}</span><small> / 5</small>
                                                        </h4>
                                                        @for($i=1; $i<=$ulasan->rating; $i++)
                                                            <button type="button" class="btn btn-warning btn-xs">
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                            </button>
                                                            <?php $banyak--; ?>
                                                        @endfor
                                                        @if($banyak >=1)
                                                            @for($i=1; $i<=$banyak; $i++)
                                                                <button type="button" class="btn btn-default btn-xs">
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                </button>
                                                                <?php $banyak--; ?>
                                                            @endfor
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea name="ulasan" readonly class="form-control" rows="4" placeholder="Masukan Ulasan Terhadap Produk">{{$ulasan->deskripsi}}</textarea>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @empty

                            @endforelse
                        @endif
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-right"><a href="{{url('/order')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Kembali ke Halaman Order</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>
        jQuery(document).ready(function($){

            $(".btnrating").on('click',(function(e) {

                var previous_value = $("#selected_rating").val();

                var selected_value = $(this).attr("data-attr");
                $("#selected_rating").val(selected_value);

                $(".selected-rating").empty();
                $(".selected-rating").html(selected_value);

                for (i = 1; i <= selected_value; ++i) {
                    $("#rating-star-"+i).toggleClass('btn-warning');
                    $("#rating-star-"+i).toggleClass('btn-default');
                }

                for (ix = 1; ix <= previous_value; ++ix) {
                    $("#rating-star-"+ix).toggleClass('btn-warning');
                    $("#rating-star-"+ix).toggleClass('btn-default');
                }

            }));


        });
    </script>
@endsection