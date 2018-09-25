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
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><i class="fa fa-file-text"></i>&nbsp;&nbsp;INFORMASI KUSTOMER</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{url('/img/user-blank.jpg')}}" class="img img-thumbnail img-responsive" alt="img">
                                    </div>
                                    <div class="col-md-8">
                                        <h3><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Informasi User</h3>
                                        <hr>
                                        <table class="table table-borderless">
                                            <tr>
                                                <th>Nama Lengkap</th>
                                                <td>:</td>
                                                <td>{{auth()->guard('customer')->user()->nama_lengkap}}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>:</td>
                                                <td>{{auth()->guard('customer')->user()->email}}</td>
                                            </tr>
                                            <tr>
                                                <th>No. HP</th>
                                                <td>:</td>
                                                <td>{{auth()->guard('customer')->user()->no_hp}}</td>
                                            </tr>
                                            <tr>
                                                <th>Pin BBM</th>
                                                <td>:</td>
                                                <td>{{auth()->guard('customer')->user()->pinbbm}}</td>
                                            </tr>
                                            <tr>
                                                <th>Username</th>
                                                <td>:</td>
                                                <td>{{auth()->guard('customer')->user()->username}}</td>
                                            </tr>
                                        </table>

                                        <div class="form-group">
                                            <a href="#" class="btn btn-primary">Update Profil</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                {{ $product->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


@endsection