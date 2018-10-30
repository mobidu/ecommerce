@extends('layouts.front')

@section('title')
    <title>Toko Fashion Online Indonesia | {{ $pengaturan->nama_toko }}</title>
    <meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                        <li class="active">Home</li>
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
                    <div class="col-md-8 col-md-offset-2 col-xs-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;Infomasi Penarikan</h3>
                            </div>
                            <div class="panel-body">
                                <h4>Informasi Customer</h4>
                                <hr />
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

                                <br />
                                <h4>Informasi Penarikan</h4>
                                <hr />

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
                                <br />
                                <br />
                                <a href="{{url('/profil')}}" class="btn btn-primary btn-block"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;Kembali Ke Halaman Profil</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>


@endsection