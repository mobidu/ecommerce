@extends('layouts.front')

@section('title')
    <title>{{ $pengaturan->nama_toko }}</title>
    <meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('') }}"><i class="fa fa-home"></i></a></li>
                        <li class="active text-capitalize"><i>Login Member</i></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row" id="content">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login Member Area</h3>
                    </div>
                    <form id="form_login" action="{{url('/login')}}" method="post">
                    <div class="panel-body">
                        @if(count($errors) > 0)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li><strong>{{$error}}</strong></li>
                                            @endforeach

                                        </ul>

                                    </div>
                                </div>
                            </div>
                        @endif

                            {{csrf_field()}}
                            <div class="form-group">
                                <label >Username : </label>
                                <input type="text" name="username"  class="form-control" value="{{old('username')}}" placeholder="Masukan Username Anda">
                            </div>
                            <div class="form-group">
                                <label >Password : </label>
                                <input type="password" name="password" class="form-control"  placeholder="Masukan Password Anda">
                            </div>
                            <div class="form-group">
                                {!! NoCaptcha::display() !!}
                            </div>
                            <div class="form-group">
                                <em>Tidak Mempunyai akun?</em> <a href="{{url('/register')}}">Daftar Sekarang</a>
                            </div>

                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary pull-right" type="submit">Login</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection