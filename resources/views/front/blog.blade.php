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

        .view-group {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: row;
            flex-direction: row;
            padding-left: 0;
            margin-bottom: 0;
        }
        .thumbnail
        {
            margin-bottom: 30px;
            padding: 0px;
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            border-radius: 0px;
        }

        .item.list-group-item
        {
            float: none;
            width: 100%;
            background-color: #fff;
            margin-bottom: 30px;
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%;
            padding: 0 1rem;
            border: 0;
        }
        .item.list-group-item .img-event {
            float: left;
            width: 30%;
        }

        .item.list-group-item .list-group-image
        {
            margin-right: 10px;
        }
        .item.list-group-item .thumbnail
        {
            margin-bottom: 0px;
            display: inline-block;
        }
        .item.list-group-item .caption
        {
            float: left;
            width: 70%;
            margin: 0;
        }

        .item.list-group-item:before, .item.list-group-item:after
        {
            display: table;
            content: " ";
        }

        .item.list-group-item:after
        {
            clear: both;
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
                @if($post->count())
                    <div class="row">
                        @forelse($post as $p)
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <img src="{{$p->gambar ? asset('upload/img/' . $p->gambar->name_photo) : asset('img/not-available.jpg')}}" style="height: 200px; width: 100%;" alt="" class="img-thumbnail img-responsive">
                                        <p class="text-muted">By <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Admin Pasare | <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> {{date('d/m/Y', strtotime($p->created_at))}}</p>
                                        <h3>{{$p->judul}}</h3>
                                        <p>{{str_limit($p->body, 100, '[...]')}}</p>
                                        <a href="{{url('/blog/'.$p->slug)}}" class="btn btn-default">Read more...</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse

                    </div>
                    <hr>
                @else
                    <div class="panel">
                        <div class="panel-body">
                            <center><h2>Belum Terdapat Artikel Terbaru.</h2></center>
                        </div>
                    </div>
                @endif
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