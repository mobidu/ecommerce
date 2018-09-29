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
                <li><a href="{{url('/admin/order')}}">Order</a></li>
                <li class="active">Pembayaran</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">

                        </div>

                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="tabel-pembayaran">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Invoice</th>
                                        <th>Nama Pemilik</th>
                                        <th>Dari Bank</th>
                                        <th>Nomor Rekening</th>
                                        <th>Tujuan Bank</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                        <th>Opsi</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->


    <script>
        $(function() {
            $('#tabel-pembayaran').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/admin/pembayaran/data',
                columns: [
                    {data: 'waktu', name: 'waktu', orderable: false, searchable: false},
                    {data: 'invoice', name: 'invoice'},
                    {data: 'nama_pemilik', name: 'nama_pemilik'},
                    {data: 'bank_from', name: 'bank_from'},
                    {data: 'no_rekening', name: 'no_rekening'},
                    {data: 'bank_to', name: 'bank_to'},
                    {data: 'jumlah', name: 'jumlah'},
                    {data: 'status_order', name: 'status_order', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endsection