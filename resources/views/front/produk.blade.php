@extends('layouts.front')

@section('title')
    <title>{{ $product->nama_produk }} | {{ $pengaturan->nama_toko }}</title>
    <meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection

@section('plugins')
    <script src="{{url('/plugins/jquery-stars/dist/stars.min.js')}}"></script>
    <style>


        .heading {
            font-size: 25px;
            margin-right: 25px;
        }

        .fa-rating {
            font-size: 25px;
        }

        .checked {
            color: orange;
        }

        /* Three column layout */
        .side {
            float: left;
            width: 15%;
            margin-top:10px;
        }

        .middle {
            margin-top:10px;
            float: left;
            width: 70%;
        }

        /* Place text to the right */
        .right {
            text-align: right;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* The bar container */
        .bar-container {
            width: 100%;
            background-color: #f1f1f1;
            text-align: center;
            color: white;
        }

        /* Individual bars */
        .bar-5 {width: 60%; height: 18px; background-color: #4CAF50;}
        .bar-4 {width: 30%; height: 18px; background-color: #2196F3;}
        .bar-3 {width: 10%; height: 18px; background-color: #00bcd4;}
        .bar-2 {width: 4%; height: 18px; background-color: #ff9800;}
        .bar-1 {width: 15%; height: 18px; background-color: #f44336;}

        /* Responsive layout - make the columns stack on top of each other instead of next to each other */
        @media (max-width: 400px) {
            .side, .middle {
                width: 100%;
            }
            .right {
                display: none;
            }
        }



    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ url('') }}"><i class="fa fa-home"></i></a></li>
                    <li class="active text-capitalize"><i>{{ $product->category->nama_kategori }}</i></li>
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
                    <div class="panel panel-default panel-sm">
                        <div class="panel-body">        
                            <div class="col-md-5">
                                <div class="thumbnail img-responsive">
                                    @if ($product->media_image_id != null)
                                        <a href="{{ url('/produk/' . $product->slug) }}"><img src="{{ asset('upload/img/' . $product->media_image->name_photo) }}" alt="{{ $product->nama_produk }}" style="min-height:50px; height:250px; min-width:50px; width: 250px;" class="morph"></a>
                                    @else
                                        <a href="{{ url('/produk/' . $p->slug) }}"><img src="{{ asset('img/not-available.jpg') }}" alt="{{ $product->nama_produk }}" style="min-height:50px; height:250px; min-width:50px; width: 250px;" class="morph"></a>
                                    @endif     
                                </div>
                            </div>  
                            <div class="col-md-7" style="margin-bottom: 20px;">
                                <h3 class="text-capitalize">{{ $product->nama_produk }}</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <td><i class="fa fa-file-code-o"></i> Kode Produk</td>
                                                <td>: {{ $product->kode_produk }}</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><i class="fa fa-briefcase"></i> Kategori</td>
                                                    <td>: <a href="{{ url('/kategori/' . $product->category->slug) }}" style="text-decoration: none;">{{ $product->category->nama_kategori }}</a></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-shopping-basket"></i> Berat</td>
                                                    <td>: {{ $product->berat }} <small>gr</small></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-money"></i> Harga</td>
                                                    <td>: Rp. {{ $product->harga_jual }}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="col-md-12">
                                        <form action="{{url('/cart')}}" method="post" class="form_submit">
                                            {{csrf_field()}}
                                            <button type="submit" class="btn btn-success btn-sm" id="beli"><i class="fa fa-shopping-cart"></i> Beli Sekarang</button>
                                            @if(request()->query('ref'))
                                                <input type="hidden" name="ref" value="{{request()->query('ref')}}">
                                            @endif
                                            <input type="hidden" name="kode_produk" id="kode_produk" value="{{ $product->kode_produk }}">
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#tab1default" aria-controls="tab1default" role="tab" data-toggle="tab"><i class="fa fa-bookmark"></i>&nbsp;&nbsp;&nbsp;Deskripsi Produk</a></li>
                                            <li role="presentation"><a href="#ulasan" data-toggle="tab" aria-controls="ulasan" role="tab"><i class="fa fa-bullhorn"></i>&nbsp;&nbsp;&nbsp;Ulasan</a></li>
                                            <li role="presentation"><a href="#diskusi" data-toggle="tab" aria-controls="diskusi" role="tab"><i class="fa fa-comment"></i>&nbsp;&nbsp;&nbsp;Diskusi</a></li>
                                        </ul>
                                    </div>
                                    <div class="panel-body" style="height: 800px; overflow-y: auto;">
                                        <div class="tab-content" style="padding: 20px;">
                                            <div class="tab-pane active" id="tab1default">
                                                {!! $product->deskripsi !!}
                                            </div>
                                            <div class="tab-pane" id="ulasan">
                                                <div class="panel">
                                                    <div class="panel-body">
                                                        <span class="heading">User Rating</span>
                                                        <span class="fa fa-rating fa-star checked"></span>
                                                        <span class="fa fa-rating fa-star checked"></span>
                                                        <span class="fa fa-rating fa-star checked"></span>
                                                        <span class="fa fa-rating fa-star checked"></span>
                                                        <span class="fa fa-rating fa-star"></span>
                                                        <p>{{floatval($product->ulasan()->avg('rating'))}} average based on {{$product->ulasan()->count()}} reviews.</p>
                                                        <hr style="border:3px solid #f1f1f1">

                                                        <div class="row">
                                                            <div class="side">
                                                                <div>5 star</div>
                                                            </div>
                                                            <div class="middle">
                                                                <div class="bar-container">
                                                                    <div class="bar-5"></div>
                                                                </div>
                                                            </div>
                                                            <div class="side right">
                                                                <div>{{$stars['5']}}</div>
                                                            </div>
                                                            <div class="side">
                                                                <div>4 star</div>
                                                            </div>
                                                            <div class="middle">
                                                                <div class="bar-container">
                                                                    <div class="bar-4"></div>
                                                                </div>
                                                            </div>
                                                            <div class="side right">
                                                                <div>{{$stars['4']}}</div>
                                                            </div>
                                                            <div class="side">
                                                                <div>3 star</div>
                                                            </div>
                                                            <div class="middle">
                                                                <div class="bar-container">
                                                                    <div class="bar-3"></div>
                                                                </div>
                                                            </div>
                                                            <div class="side right">
                                                                <div>{{$stars['3']}}</div>
                                                            </div>
                                                            <div class="side">
                                                                <div>2 star</div>
                                                            </div>
                                                            <div class="middle">
                                                                <div class="bar-container">
                                                                    <div class="bar-2"></div>
                                                                </div>
                                                            </div>
                                                            <div class="side right">
                                                                <div>{{$stars['2']}}</div>
                                                            </div>
                                                            <div class="side">
                                                                <div>1 star</div>
                                                            </div>
                                                            <div class="middle">
                                                                <div class="bar-container">
                                                                    <div class="bar-1"></div>
                                                                </div>
                                                            </div>
                                                            <div class="side right">
                                                                <div>{{$stars['1']}}</div>
                                                            </div>
                                                        </div>
                                                        <br />
                                                        <br />
                                                        @forelse($product->ulasan as $ulasan)
                                                            <div class="media">
                                                                <div class="media-left">
                                                                    <a href="#">
                                                                        <img alt="{{$ulasan->customer->nama_lengkap}}" class="media-object" src="{{url('/img/user-blank.jpg')}}"  data-holder-rendered="true" style="width: 64px; height: 64px;">
                                                                    </a>
                                                                </div>
                                                                <div class="media-body">
                                                                    <div class="panel panel-default">
                                                                        <div class="panel-heading">
                                                                            <h4 class="panel-title">
                                                                                {{$ulasan->customer->nama_lengkap}}

                                                                                <div class="pull-right">
                                                                                    <span class="fa  fa-star checked"></span> <b>{{$ulasan->rating}}</b>
                                                                                </div>
                                                                            </h4>

                                                                        </div>
                                                                        <div class="panel-body">
                                                                            {{$ulasan->deskripsi}}
                                                                        </div>

                                                                    </div>


                                                                </div>
                                                            </div>
                                                        @empty

                                                        @endforelse

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="diskusi">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="panel">

                                                            <div class="panel-body">
                                                                @if(session()->has('sukses'))
                                                                    <div class="alert alert-success">
                                                                        {{session('sukses')}}
                                                                    </div>
                                                                @endif
                                                                <form action="{{route('produk.simpan_diskusi', ['id_barang'=>$product->id])}}" method="post" enctype="multipart/form-data">
                                                                    {{csrf_field()}}
                                                                    <div class="form-group">
                                                                        <textarea name="komentar" class="form-control" rows="6" placeholder="Masukan yang ingin anda tanyakan tentang produk ini"></textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn btn-primary">Komentar</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                @forelse($product->diskusi()->whereNull('parent')->orderBy('created_at', 'desc')->get() as $diskusi)
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="#">
                                                                <img class="media-object" src="{{url('/img/user-blank.jpg')}}"  data-holder-rendered="true" style="width: 64px; height: 64px;">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h4 class="panel-title">
                                                                        {{$diskusi->customer ? $diskusi->customer->nama_lengkap : 'admin'}}<br />
                                                                        <small class="text-muted">{{$diskusi->created_at->diffForHumans()}}</small>
                                                                    </h4>
                                                                </div>
                                                                <div class="panel-body">
                                                                    {{$diskusi->deskripsi}}
                                                                </div>
                                                                @if(Auth::guard('admin')->check())
                                                                    <form action="{{route('produk.simpan_balasan_diskusi', ['id_barang'=>$product->id, 'id_parent'=>$diskusi->id])}}" method="post" enctype="multipart/form-data">
                                                                        {{csrf_field()}}
                                                                        <div class="panel-footer">
                                                                            <div class="row">
                                                                                <div class="col-md-10">
                                                                                    <div class="form-group">
                                                                                    <textarea name="komentar" id="komentar" rows="4"
                                                                                              class="form-control"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <div class="pull-right">
                                                                                        <button class="btn btn-primary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;&nbsp;Balas</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>

                                                                @endif
                                                            </div>

                                                            @forelse($diskusi->child as $balasan)
                                                                <div class="media">
                                                                    <div class="media-left">
                                                                        <a href="#">
                                                                            <img class="media-object" src="{{url('/img/user-blank.jpg')}}"  data-holder-rendered="true" style="width: 64px; height: 64px;">
                                                                        </a>
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <div class="panel panel-default">
                                                                            <div class="panel-heading">
                                                                                <h4 class="panel-title">
                                                                                    {{$balasan->customer ? $balasan->customer->nama_lengkap : 'Admin'}}<br />
                                                                                    <small class="text-muted">{{$balasan->created_at->diffForHumans()}}</small>
                                                                                </h4>
                                                                            </div>
                                                                            <div class="panel-body">
                                                                                {{$balasan->deskripsi}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @empty
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                @empty

                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

    $(document).ready(function() {
        $('.rating-pembeli').stars({ color:'#73AD21' });
        $(".form_submit").submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize(); 
            var formAction = $(this).attr("action"); 
            var formMethod = $(this).attr("method");

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
        });
    });
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