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
            </div>
        </div>
    </div>
    </div>


@endsection