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

        .card-img-top {
            width: 100%; // Required because we use flexbox and this inherently applies align-self: stretch
            border-top-left-radius: calc(.25rem - 1px);
            border-top-right-radius: calc(.25rem - 1px);
            height: 300px;
        }


    </style>
@endsection
@section('plugins')
    <link rel="stylesheet" href="{{url('/plugins/owl-carousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url('/plugins/owl-carousel/assets/owl.theme.green.css')}}">
    <script src="{{url('/plugins/owl-carousel/owl.carousel.min.js')}}"></script>
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
                <h1 class="mt-4">{{$post->judul}}</h1>
                <p class="lead">By. Admin Pasare</p>
                <hr>
                <p class="text-muted"><i class="fa fa-calendar"></i>&nbsp;&nbsp;&nbsp; {{date('d-m-Y', strtotime($post->created_at))}}&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <i class="fa fa-user"></i>&nbsp;&nbsp;Admin Pasare</p>
                <hr>
                <img class="card-img-top" src="{{$post->gambar ? asset('upload/img/' . $post->gambar->name_photo) : asset('img/not-available.jpg')}}" alt="{{$post->judul}}">
                <hr>

                {!! $post->body !!}
            </div>




            <!-- Modal -->
            <div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;" id="pesanmodal">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><i class="fa fa-info-circle fa-2x"></i></h4>
                        </div>
                        <div class="modal-body">
                            <p><strong class="pmodal"></strong> Berhasil Ditambahkan Ke Keranjang.</p>
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary pull-left" data-dismiss="modal"><i class="fa fa-hand-o-left"></i> Lanjutkan Belanja</button>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ url('/cart') }}"><button type="button" class="btn btn-primary pull-right"><i class="fa fa-shopping-cart"></i> Keranjang</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection