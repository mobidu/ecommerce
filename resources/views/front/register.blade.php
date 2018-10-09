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

                        <form id="form_login" action="{{url('/register')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group {{ $errors->has('nama_lengkap') ? 'has-error' : '' }}">
                                <label >Nama Lengkap * : </label>
                                <input type="text" name="nama_lengkap" class="form-control" value="{{old('nama_lengkap')}}" placeholder="Masukan Nama Lengkap Anda">
                                @if ($errors->has('nama_lengkap'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_lengkap') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label >Email * : </label>
                                <input type="text" name="email" class="form-control" value="{{old('email')}}" placeholder="Masukan Email Anda">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('no_hp') ? 'has-error' : '' }}">
                                <label >No HP * : </label>
                                <input type="text" name="no_hp" class="form-control" value="{{old('no_hp')}}" placeholder="Masukan No Handphone Anda">
                                @if ($errors->has('no_hp'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('no_hp') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('bbm') ? 'has-error' : '' }}">
                                <label >Pin BB : </label>
                                <input type="text" name="bbm" class="form-control" value="{{old('bbm')}}" placeholder="Masukan Pin BBM Anda">
                                @if ($errors->has('bbm'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bbm') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                                <label >Username : </label>
                                <input type="text" name="username" class="form-control" value="{{old('username')}}" placeholder="Masukan Username Anda">
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label >Password : </label>
                                <input type="password" name="password" class="form-control"  placeholder="Masukan Password Anda">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password-confirm"">Konfirmasi Password </label>

                                    <input id="password-confirm" type="password" placeholder="Konfirmasi Password" class="form-control" name="password_confirmation" required>
                            </div>
                            <div class="form-group">
                                {!! NoCaptcha::display() !!}
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary pull-right" onclick="event.preventDefault(); document.getElementById('form_login').submit()">Login</button>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        Sudah Mempunyai Akun ? <a href="{{url('/login')}}" class="label label-primary">ke Halaman Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection