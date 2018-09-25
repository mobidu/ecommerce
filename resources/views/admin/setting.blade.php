@extends('layouts.master')

@section('title')
    <title>Setting | {{ $pengaturan->nama_toko }}</title>
    <meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection

@section('plugin')

@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Setting
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Setting</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- START CUSTOM TABS -->
            <h2 class="page-header"></h2>
            <div class="row">
                <div class="col-md-12">
                    <!-- Custom Tabs (Pulled to the right) -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs pull-right">
                            <li class="active"><a href="#general" data-toggle="tab">General</a></li>
                            <li><a href="#contact" data-toggle="tab">Contact</a></li>
                            <li class="pull-left header"><i class="fa fa-th"></i> </li>
                        </ul>
                        <form class="form-horizontal" action="{{url('/admin/setting/update')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="tab-content">
                                <div class="tab-pane active" id="general" style="padding:20px;">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Nama Toko</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="nama_toko" id="nama_toko" class="form-control" value="{{$pengaturan->nama_toko}}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Nama Pemilik</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="nama_pemilik" id="nama_pemilik" class="form-control" value="{{$pengaturan->nama_pemilik}}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <textarea name="alamat" id="alamat" class="form-control" rows="6">{{$pengaturan->alamat}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Provinsi</label>
                                        <div class="col-sm-10">
                                            <select id="provinsi_id" class="form-control" name="provinsi_id">
                                                @foreach ($provinsi as $p)
                                                    <option {{  $p['province_id'] == $pengaturan->provinsi_id ?'selected':'' }} value="{{ $p['province_id'] }}">{{ $p['province'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Kabupaten</label>
                                        <div class="col-sm-10">
                                            <select name="kabupaten_id" class="form-control" id="kabupaten_id">
                                                <option value="{{ $pengaturan->kabupaten_id }}" id="hkabupaten">{{ $kabupaten['city_name']}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="contact" style="padding:20px;">
                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">SMS/Whatsapp</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{$pengaturan->sms}}" class="form-control" id="sms" name="sms">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">BBM</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{$pengaturan->bbm}}" class="form-control" id="bbm" name="bbm">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">Line @</label>

                                        <div class="col-sm-10">
                                            <input type="text" name="line" class="form-control" value="{{$pengaturan->line}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Instagram</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="instagram" id="instagram" value="{{$pengaturan->instagram}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" name="email" class="form-control" id="email">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="form-group pull-right">
                                        <button type="submit" class="btn btn-primary" style="margin-right: 30px;">Simpan</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div><!-- nav-tabs-custom -->
                </div><!-- /.col -->
            </div> <!-- /.row -->
            <!-- END CUSTOM TABS -->

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->


    <script type="text/javascript">
        $("#provinsi_id").change(function(){
            $.ajax({
                url: "/admin/setting/kabupaten",
                type:"POST",
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf_token"]').attr('content');

                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                data: { id : $("#provinsi_id").val() },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var kabupaten = $("#kabupaten_id"), options = '';
                    kabupaten.empty();
                    //
                    for(var i=0;i<data.length; i++)
                    {
                        options += "<option value='"+data[i].city_id+"'>"+ data[i].city_name +"</option>";
                    }
                    $("#hkabupaten").remove();
                    $("#kabupaten_id").append(options);
                    $("#kabupaten_id").fadeIn();
                    //
                },error:function(){
                    alert("error!!!!");
                }
            });
        });
    </script>
@endsection