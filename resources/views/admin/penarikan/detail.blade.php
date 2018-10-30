@extends('layouts.master')

@section('title')
    <title>Konfirmasi Request Pembayaran | {{ $pengaturan->nama_toko }}</title>
    <meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Konfirmasi Permohonan Penarikan<small></small></h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{url('/admin/order')}}">Order</a></li>
                <li class="active">Konfirmasi Request Pembayaran</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><i class="fa fa-user"></i>&nbsp;&nbsp;Data Customer</h3>
                        </div>

                        <div class="box-body">
                            <table class="table">
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td>:</td>
                                    <td>{{$penarikan->customer->nama_lengkap}}</td>
                                </tr>
                                <tr>
                                    <th>No. HP</th>
                                    <td>:</td>
                                    <td>{{$penarikan->customer->no_hp}}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>:</td>
                                    <td>{{$penarikan->customer->email}}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Registrasi</th>
                                    <td>:</td>
                                    <td>{{date('d-m-Y', strtotime($penarikan->customer->created_at))}}</td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div><!-- /.col -->
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><i class="fa fa-file"></i>&nbsp;&nbsp;Data Ajuan</h3>
                        </div>
                        <div class="box-body">
                            <table class="table">
                                <tr>
                                    <th>Nomor Rekening</th>
                                    <td>:</td>
                                    <td>{{$penarikan->no_rek}}</td>
                                </tr>
                                <tr>
                                    <th>Nama Pemilik</th>
                                    <td>:</td>
                                    <td>{{$penarikan->nama_pemilik}}</td>
                                </tr>
                                <tr>
                                    <th>Jumlah</th>
                                    <td>:</td>
                                    <td>Rp. {{number_format($penarikan->jumlah)}},-</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>:</td>
                                    <td>{!! $penarikan->status == 'menunggu' ? '<span class="label label-warning">Menunggu</span>' : '<span class="label label-success">Selesai</span>'!!}</td>
                                </tr>

                                <tr>
                                    <th>Ditransfer dari Rekening</th>
                                    <td>:</td>
                                    <td>{{$penarikan->pencairan->rekening->nama_pemilik.' ('.$penarikan->pencairan->rekening->provider->nama.')'}}</td>
                                </tr>
                                <tr>
                                    <th>No Rekening Pengirim</th>
                                    <td>:</td>
                                    <td>{{$penarikan->pencairan->rekening->no_rekening}}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Mengirim</th>
                                    <td>:</td>
                                    <td>{{date('d-m-Y', strtotime($penarikan->pencairan->created_at))}}</td>
                                </tr>
                                <tr>
                                    <th>Bukti Pengiriman</th>
                                    <td>:</td>
                                    <td><a href="{{$penarikan->pencairan->bukti}}" target="_blank"><i class="fa fa-tag"></i>&nbsp;&nbsp;Bukti Pengiriman</a></td>
                                </tr>

                            </table>
                        </div>

                    </div>
                </div>
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

@endsection