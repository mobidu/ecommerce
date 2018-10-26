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
                            <div class="panel-heading">
                                <i class="fa fa-users"></i>&nbsp;&nbsp;Link Affiliate

                            </div>
                            <div class="panel-body">
                                <h3 class="text-center">Berikut merupakan link yang dapat digunakan untuk mendaftarkan affiliasi kustomer, copy link berikut untuk membagikan link rujukan :</h3>
                                <br />
                                <input type="text" class="form-control" value="{{url('/register?ref='.auth()->guard('customer')->user()->affiliate_id)}}" style="padding: 20px;text-align: center; font-size: large; font-weight: bold;" readonly>
                                <br/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-body bg-primary text-aqua" style="border-radius: 10px;">
                                <table>
                                    <tr>
                                        <th><h2>Saldo Anda</h2></th>
                                        <td>:</td>
                                        <td><h2>Rp. {{auth()->guard('customer')->user() ? number_format(auth()->guard('customer')->user()->saldo) : '0'}},-</h2></td>
                                    </tr>
                                </table>
                                <a href="#" class="btn btn-success btn-cairkan" onclick=""><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Ajukan Pencairan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <i class="fa fa-id-card"></i>&nbsp;&nbsp;Referal User

                            </div>
                            <div class="panel-body" style="height: 300px; overflow-y: auto;">
                                <table class="table table-bordered" >
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Nama Lengkap</th>
                                        <th class="text-center">No HP</th>
                                        <th class="text-center">Saldo</th>
                                        <th class="text-center">Tanggal Daftar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $urut = 1; ?>
                                    @forelse(auth()->guard('customer')->user()->affiliasi as $affiliasi)
                                        <tr>
                                            <td align="center">{{$urut}}</td>
                                            <td>{{$affiliasi->nama_lengkap}}</td>
                                            <td align="center">{{$affiliasi->no_hp}}</td>
                                            <td align="right">Rp. {{$affiliasi->saldo ? number_format($affiliasi->saldo) : '0'}},-</td>
                                            <td align="center">{{date('d-m-Y', strtotime($affiliasi->created_at))}}</td>
                                        </tr>
                                        <?php $urut++; ?>
                                    @empty
                                        <tr>
                                            <td colspan="5" align="center">Tidak Terdapat Refferal yang terdaftar dari ID Anda</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
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
               if(saldo < 1){
                   event.preventDefault();
                   alert("Saldo Tidak Mencukupi!");
               }
            });
        });


    </script>
@endsection