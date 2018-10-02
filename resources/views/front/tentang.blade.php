@extends('layouts.front')

@section('title')
    <title>Toko Fashion Online Indonesia | {{ $pengaturan->nama_toko }}</title>
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <style>
        /* original solution by https://codepen.io/Rowno/pen/Afykb */

        .carousel-fade .carousel-inner .item {
            -webkit-transition-property: opacity;
            transition-property: opacity;
        }
        .carousel-fade .carousel-inner .item,
        .carousel-fade .carousel-inner .active.left,
        .carousel-fade .carousel-inner .active.right {
            opacity: 0;
        }
        .carousel-fade .carousel-inner .active,
        .carousel-fade .carousel-inner .next.left,
        .carousel-fade .carousel-inner .prev.right {
            opacity: 1;
        }
        .carousel-fade .carousel-inner .next,
        .carousel-fade .carousel-inner .prev,
        .carousel-fade .carousel-inner .active.left,
        .carousel-fade .carousel-inner .active.right {
            left: 0;
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }
        .carousel-fade .carousel-control {
            z-index: 2;
        }
    </style>
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
                <div class="panel">
                    <img src="{{$pengaturan->banner_toko ? url('/img/'.$pengaturan->banner_toko) : url('/upload/banner/G8U0sn.jpg')}}" width="100%" height="200" alt="img">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h3>{{$pengaturan->nama_toko}}</h3>
                                {!! $pengaturan->deskripsi_lengkap ? $pengaturan->deskripsi_lengkap : '<p>Deskripsi Lengkap </p>' !!}
                            </div>
                            <div class="col-md-4">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Lokasi Tempat</h4>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th>Alamat</th>
                                                <td>:</td>
                                                <td>{{$pengaturan->alamat}} sad asd asd asdasdasdafds fafsad</td>
                                            </tr>
                                            <tr>
                                                <th>No Telp</th>
                                                <td>:</td>
                                                <td>{{$pengaturan->sms}}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>:</td>
                                                <td>pasare@gmail.com</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <iframe src="{{$pengaturan->map ? $pengaturan->map : 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.441877691678!2d107.87837211432!3d-7.190315472569598!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68b0949802df0b%3A0x796a2d607407127a!2sMobidu+Sinergi!5e0!3m2!1sen!2sid!4v1538453494787'}}" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>

            </div>

        </div>
    </div>
    </div>
    <script>
        $('p img').css('width', '100%');
    </script>
@endsection
