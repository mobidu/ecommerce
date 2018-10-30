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
                    <div class="col-md-6 col-xs-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;Infomasi Penarikan</h3>
                            </div>
                            <div class="panel-body">
                                <h4>Perhatian!</h4>
                                <ol>
                                    <li>Minimal Penarikan harus Rp. 50.000,-.</li>
                                    <li>Penarikan harus berkelipatan Rp. 50.000</li>
                                    <li>Jam Penarikan akan dilayani pada pukul 09.00 - 14.00 Selebihnya akan dilayani pada keesokan harinya</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Form Penarikan Saldo</h3>
                            </div>
                            <div class="panel-body">
                                @if(session()->has('sukses'))
                                    <div class="alert alert-success">{{session('sukses')}}</div>
                                @endif
                                <form action="{{url('/affiliate/penarikan')}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <input type="hidden" name="id_affiliate" value="{{auth()->guard('customer')->user()->affiliate_id}}">
                                    <div class="form-group {{$errors->has('no_rekening') ? 'has-error' : ''}}">
                                        <label>Nomor Rek.</label>
                                        <input type="text" name="no_rekening" class="form-control " placeholder="Masukan Nomor Rekening">
                                        @if($errors->has('no_rekening'))
                                            <span class="help-block"><strong>{{$errors->first('no_rekening')}}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{$errors->has('nama_pemilik') ? 'has-error' : ''}}">
                                        <label>Nama Pemilik</label>
                                        <input type="text" name="nama_pemilik" class="form-control" placeholder="Masukan Nama Pemilik Rekening">
                                        @if($errors->has('nama_pemilik'))
                                            <span class="help-block"><strong>{{$errors->first('nama_pemilik')}}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{$errors->has('jumlah') ? 'has-error' : ''}}">
                                        <label>Jumlah Penarikan</label>
                                        <input type="number" name="jumlah" class="form-control" placeholder="Minimal Rp. 50.000,- atau kelipatannya">
                                        @if($errors->has('jumlah'))
                                            <span class="help-block"><strong>{{$errors->first('jumlah')}}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block" type="submit" {{auth()->guard('customer')->user()->saldo < 50000 ? 'disabled' : ''}}><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Ajukan</button>
                                        {{--<input type="submit" class="btn btn-primary btn-block" value="Ajukan">--}}
                                    </div>
                                </form>
                            </div>
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
            var saldo = {{auth()->guard('customer')->user()->saldo ? auth()->guard('customer')->user()->saldo : 0}};
            $('.btn-cairkan').on('click', function(){
                if(saldo < 50000){
                    event.preventDefault();
                    alert("Saldo Tidak Mencukupi!");
                }
            });
        });


    </script>
@endsection