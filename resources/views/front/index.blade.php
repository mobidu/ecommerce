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
            <div class="row carousel-holder">

                <div class="col-md-12">
                    <div id="carousel-produk-generic" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php $pertama = 1; ?>
                            @foreach($list_slide as $slide)
                                <li data-target="#carousel-produk-generic" data-slide-to="{{$pertama}}" class="{{$pertama == 1 ? 'active' : '' }}"></li>
                                <?php $pertama++; ?>
                            @endforeach
                            {{--<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>--}}
                            {{--<li data-target="#carousel-example-generic" data-slide-to="1"></li>--}}
                            {{--<li data-target="#carousel-example-generic" data-slide-to="2"></li>--}}
                        </ol>
                        <div class="carousel-inner">
                            <?php $pertama2 = 1; ?>
                            @foreach($list_slide as $slide)
                                <div class="item {{$pertama2 == 1 ? 'active' : ''}}">
                                    <img class="slide-image" href="{{$slide->url}}" src="{{asset('/upload/banner/' . $slide->banner_slide)}}" alt="{{$slide->deskripsi}}">

                                </div>
                                    <?php $pertama2++; ?>
                            @endforeach

                        </div>
                        <a class="left carousel-control" href="#carousel-produk-generic" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-produk-generic" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-center">KOLEKSI TERBARU</div>
                            <div class="panel-body">
                                @foreach ($product as $p)
                                    @if ($p->publish == 1)
                                    <div class="col-md-3 col-xs-6">
                                        <div class="thumbnail img-responsive">
                                            @if ($p->media_image_id != null)
                                                <a href="{{ url('/produk/' . $p->slug) }}"><img src="{{ asset('upload/img/' . $p->media_image->name_photo) }}" alt="{{ $p->nama_produk }}" style="min-height:50px; height:150px; min-width:50px; width: 150px;" class="morph"></a>
                                            @else
                                                <a href="{{ url('/produk/' . $p->slug) }}"><img src="{{ asset('img/not-available.jpg') }}" alt="{{ $p->nama_produk }}" style="min-height:50px; height:250px; min-width:50px; width: 150px;" class="morph"></a>
                                            @endif
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="text-uppercase text-center">
                                                        <a href="{{ url('/produk/' . $p->slug) }}">{{ str_limit($p->nama_produk, 15) }}</a>
                                                    </p>
                                                    <p class="text-center text-uppercase">({{ $p->kode_produk }})</p>
                                                </div>
                                                <div class="col-md-12">
                                                    <p class="text-center harga">Rp. {{ $p->harga_jual }} @if ($p->diskon != 0)<sup><s>{{ $p->harga }}</s></sup>@endif</p>
                                                </div>
                                                <div class="col-md-12 text-center" style="padding: 20px;">
                                                        <a href="{{ url('/produk/' . $p->slug) }}"><button class="btn btn-default btn-sm">Detail</button></a>
                                                        <button type="submit" onclick="submitForm({{$p->id}})" class="btn btn-success btn-sm" id="beli"><i class="fa fa-shopping-cart"></i> Beli</button>
                                                    <form action="{{url('/cart')}}" id="form_submit_{{$p->id}}" method="post">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="kode_produk" id="kode_produk" value="{{$p->kode_produk}}">
                                                        @if(request()->query('ref'))
                                                            <input type="hidden" name="ref" value="{{request()->query('ref')}}">
                                                        @endif
                                                    </form>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="text-center"> 
                                {{ $product->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center">Artikel Terbaru</h3>
                        <hr />

                        @if($list_post->count() > 1)
                            <div class="owl-carousel owl-theme">
                                @forelse($list_post as $post)
                                    <div class=" item">
                                        <div class="post">
                                            <div class="post-img-content">
                                                <img src="{{$post->gambar ?  asset('upload/img/' . $post->gambar->name_photo) : asset('img/not-available.jpg')}}" style="width: 150px; height: 150px; text-align: center;" class="img-responsive" />
                                            </div>
                                            <div class="content">
                                                <div class="author text-muted hidden-xs">
                                                    <small>
                                                        By <b>Admin Pasare</b> |
                                                        {{date('d-m-Y', strtotime($post->created_at))}}
                                                    </small>

                                                </div>
                                                <h5 style="font-weight: bold; text-align: center">
                                                    {{$post->judul}}
                                                </h5>
                                                <div style="text-align: center;">
                                                    <a href="{{url('/blog/'.$post->slug)}}" class="btn btn-warning btn-sm">Read more</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="panel">
                                        <div class="panel-body">
                                            <center><h3 class="text-muted">Tidak Terdapat Artikel</h3></center>
                                        </div>
                                    </div>
                                @endforelse

                            </div>
                        @else
                            <div class="panel">
                                <div class="panel-body">
                                    <center><h3 class="text-muted">Tidak Terdapat Artikel</h3></center>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
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
</div>

<script>
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
    });
    function submitForm(id){
        console.log('Submit 1');
        event.preventDefault();

        var formData = $('#form_submit_'+id).serialize();
        var formAction = $('#form_submit_'+id).attr("action");
        var formMethod = $('#form_submit_'+id).attr("method");

        $.ajaxSetup({
            headers: {
                "X-XSRF-Token": $("meta[name='csrf_token']").attr("content")
            }
        });

        $.ajax({
            type  : formMethod,
            url   : formAction,
            data  : formData,
            success: function(data) {
                waitingDialog.show('Menambahkan Ke keranjang, Silahkan Tunggu...');
                setTimeout(function(){
                    waitingDialog.hide();
                    $("#pesanmodal").modal();
                }, 1500);
            },
            error : function() {

            }
        });
        return false;
    }
</script>

<script type="text/javascript">
    var waitingDialog = waitingDialog || (function ($) {
    'use strict';

    var $dialog = $(
        '<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
        '<div class="modal-dialog modal-m">' +
        '<div class="modal-content">' +
            '<div class="modal-header"><h3 style="margin:0;"></h3></div>' +
            '<div class="modal-body">' +
                '<div class="progress progress-striped active" style="margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>' +
            '</div>' +
        '</div></div></div>');

    return {
        show: function (message, options) {
            if (typeof options === 'undefined') {
                options = {};
            }
            if (typeof message === 'undefined') {
                message = 'Loading';
            }
            var settings = $.extend({
                dialogSize: 'm',
                progressType: '',
                onHide: null
            }, options);

            $dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
            $dialog.find('.progress-bar').attr('class', 'progress-bar');
            if (settings.progressType) {
                $dialog.find('.progress-bar').addClass('progress-bar-' + settings.progressType);
            }
            $dialog.find('h3').text(message);
            if (typeof settings.onHide === 'function') {
                $dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
                    settings.onHide.call($dialog);
                });
            }
            $dialog.modal();
        },
        hide: function () {
            $dialog.modal('hide');
        }
    };

})(jQuery);
</script>

@endsection