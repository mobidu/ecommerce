@extends('layouts.master')

@section('title')
    <title>Pembayaran | {{ $pengaturan->nama_toko }}</title>
    <meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection

@section('plugin')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    {{--<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">--}}
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Data Pembayaran<small></small></h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{url('/admin/pembayaran')}}">Pembayaran</a></li>
                <li class="active">Detile : #{{$data->order->invoice}}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <i class="fa fa-money"></i>&nbsp;&nbsp;Konfirmasi Pembayaran
                        </div>

                        <div class="box-body">
                            <div class="col-md-8">
                                <h4>Informasi Pembayaran untuk Invoice #{{$data->order->invoice}}</h4>
                                <hr>
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="20%">No Invoice</th>
                                        <td width="10%">:</td>
                                        <td><a href="{{url('/admin/order/'.$data->invoice)}}" target="_blank">#{{$data->invoice}}</a></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Nama Pemilik</th>
                                        <td width="10%">:</td>
                                        <td>{{$data->nama_pemilik}}</td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Nomor Rekening</th>
                                        <td width="10%">:</td>
                                        <td>{{$data->no_rekening}}</td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Dari Bank</th>
                                        <td width="10%">:</td>
                                        <td>{{$data->bank_from}}</td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Ke Rekening</th>
                                        <td width="10%">:</td>
                                        <td>{{$data->bank_to}}</td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Jumlah</th>
                                        <td width="10%">:</td>
                                        <td>Rp. {{number_format($data->jumlah)}}</td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Bukti</th>
                                        <td width="10%">:</td>
                                        <td><a href="{{url('/storage/'.substr($data->bukti_transfer, 7))}}">Bukti Transfer</a></td>
                                    </tr>

                                </table>
                            </div>
                            <div class="col-md-4">
                                @if($data->status == 'menunggu')
                                <div class="form-group">
                                    <a href="{{url('/admin/pembayaran/konfirmasi/'.$data->invoice)}}" onclick="event.preventDefault(); if(confirm('Apakah Anda Yakin Ingin Mengkonfirmasi pembayaran ini?')){document.getElementById('konfirmasi_pembayaran').submit()}" class="btn btn-primary btn-block">Konfirmasi Pembayaran</a>
                                    <form id="konfirmasi_pembayaran" action="{{url('/admin/pembayaran/konfirmasi/'.$data->invoice)}}" method="post">{{csrf_field()}}</form>
                                </div>
                                <div class="form-group">
                                    <a href="{{url('/admin/pembayaran/tolak_konfirmasi/'.$data->invoice)}}" onclick="event.preventDefault(); if(confirm('Apakah Anda Yakin Ingin Menolak pembayaran ini?')){document.getElementById('tolak_pembayaran').submit()}" class="btn btn-danger btn-block">Tolak Pembayaran</a>
                                    <form id="tolak_pembayaran" action="{{url('/admin/pembayaran/tolak_konfirmasi/'.$data->invoice)}}" method="post">{{csrf_field()}}</form>
                                </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->


    <script>
        $(function() {
            
        });
    </script>
@endsection