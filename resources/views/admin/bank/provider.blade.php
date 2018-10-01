@extends('layouts.master')

@section('title')
    <title>Slide | {{ $pengaturan->nama_toko }}</title>
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
            <h1>Data Provider Bank<small></small></h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Data Bank</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-md-4">

                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <h4>Tambah Data Bank</h4>
                            @if (count($errors) > 0)
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-ban"></i> Notification</h4>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <hr>
                            <form action="{{route('admin.simpan_bank_provider')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="kode" class="col-sm-4 control-label">Kode Bank *</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="kode" class="form-control" id="kode" placeholder="Masukan Kode Bank">
                                    </div>
                                </div>

                            <div class="form-group">
                                <label for="nama" class="col-sm-4 control-label">Nama Bank *</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukan Nama Bank">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="logo" class="col-sm-4 control-label">Logo *</label>
                                <div class="col-sm-8">

                                    <input type="file" name="logo" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-4"></label>
                                <div class="col-sm-8">
                                    <button type="submit" class="btn btn-primary pull-right" id="simpan">Simpan</button>
                                </div>
                            </div>
                            </form>


                        </div><!-- /.box-body -->
                    </div><!-- /.box -->


                </div><!-- /.col -->

                <div class="col-md-8">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><i class="fa fa-money"></i>&nbsp;&nbsp;Data Provider Bank</h3>
                        </div><!-- /.box-header -->

                        <div class="box-body">
                            <div class="table-responsive table-striped">
                                <table class="table table-striped table-bordered display" id="bank">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Logo</th>
                                        <th>Kode Bank</th>
                                        <th>Nama Bank</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $urut = 1; ?>
                                    @forelse($list_bank as $bank)
                                        <tr>
                                            <td>{{$urut}}</td>
                                            <td><img src="{{ asset('/img/' . $bank->logo) }}" class="img-responsive img-thumbnail" width="70"></td>
                                            <td>{{$bank->kode}}</td>
                                            <td>{{$bank->nama}}</td>
                                            <td>
                                                <a href="#" class="btn btn-danger btn-xs" onclick="event.preventDefault(); if(confirm('Apakah Anda Yakin ingin Menghapus Data Bank?')){document.getElementById('bank_{{$bank->id}}').submit()}"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus</a>
                                                <form id="bank_{{$bank->id}}" action="{{url('/admin/bank/hapus/'.$bank->id)}}" method="post">
                                                    {{csrf_field()}}
                                                </form>
                                            </td>
                                        </tr>
                                        <?php $urut++; ?>
                                    @empty
                                        <tr>
                                            <td colspan="5" align="center">Tidak Terdapat Data Bank</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <script>
        $(function() {
            $("#bank").DataTable({
                columnDefs: [ {
                    "visible": false, "orderable": false
                }]
            });
        });
    </script>
@endsection