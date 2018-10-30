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
                                    <td>{{$request_penarikan->customer->nama_lengkap}}</td>
                                </tr>
                                <tr>
                                    <th>No. HP</th>
                                    <td>:</td>
                                    <td>{{$request_penarikan->customer->no_hp}}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>:</td>
                                    <td>{{$request_penarikan->customer->email}}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Registrasi</th>
                                    <td>:</td>
                                    <td>{{date('d-m-Y', strtotime($request_penarikan->customer->created_at))}}</td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div><!-- /.col -->
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><i class="fa fa-file"></i>&nbsp;&nbsp;Form Konfirmasi</h3>
                        </div>
                        <form action="{{url('/admin/request_penarikan/konfirmasi')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="id_penarikan" value="{{$request_penarikan->id}}">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Total Transfer</label>
                                    <input type="text"  value="Rp. {{number_format($request_penarikan->jumlah)}} ,-" readonly class="form-control">
                                    <input type="hidden" name="jumlah" value="{{$request_penarikan->jumlah}}">
                                </div>
                                <div class="form-group">
                                    <label>Bukti</label>
                                    <input type="file" name="bukti" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Pilih Bank</label>
                                    <select name="bank" id="bank" class="form-control">
                                        <option value="">Pilih Bank</option>
                                        @forelse($bank as $b)
                                            <option value="{{$b->id}}">{{$b->no_rekening}} | {{$b->provider->nama}}</option>
                                        @empty

                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-money"></i>&nbsp;&nbsp;Konfirmasi</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

@endsection