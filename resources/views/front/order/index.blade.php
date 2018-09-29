@extends('layouts.front')

@section('title')
    <title>Order Customer | {{ $pengaturan->nama_toko }}</title>
    <meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                        <li class="active">Histori Transaksi</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row" id="content">
            <div class="col-md-3">
                @include('includes.sidebar')
            </div>

            <div class="col-md-9">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <i class="fa fa-cart-arrow-down"></i>&nbsp;&nbsp;Histori Transaksi
                        </h4>

                    </div>
                    <div class="panel-body">
                        <ul class="nav nav-tabs tabs-up" id="friends">
                            <li class="active"><a href="/order/data/aktif" data-target="#aktif" id="aktif_tabs" data-toggle="tabajax" rel="tooltip"> <strong>Aktif </strong></a></li>
                            <li><a href="/order/data/selesai" data-target="#selesai" class="media_node span" id="selesai_tabs" data-toggle="tabajax" rel="tooltip"> Selesai</a></li>
                            <li><a href="/order/data/batal" data-target="#batal" class="media_node span" id="batal_tabs" data-toggle="tabajax" rel="tooltip"> Batal</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="aktif" >

                            </div>
                            <div class="tab-pane" id="selesai">

                            </div>
                            <div class="tab-pane  urlbox span8" id="batal">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $.get('/order/data/aktif', function(data){
                $('#aktif').html(data);
            });
        });
        $('[data-toggle="tabajax"]').click(function(e) {
            event.preventDefault();
            var $this = $(this),
                loadurl = $this.attr('href'),
                targ = $this.attr('data-target');

            $.get(loadurl, function(data) {
                $(targ).html(data);

            });

            $this.tab('show');
            return false;
        });

    </script>
@endsection