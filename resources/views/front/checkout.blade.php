@extends('layouts.front')

@section('title')
    <title>Checkout | {{ $pengaturan->nama_toko }}</title>
    <meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ url('') }}"><i class="fa fa-home"></i></a></li>
                    <li class="active">Checkout</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row" id="content">
        <div class="col-md-7">
            @if (count($cart))
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5>Detail Informasi</h5>
                            </div>
                            <div class="panel-body">
                                {!! Form::open(array('url' => '/checkout', 'class' => 'form-horizontal')) !!}

                                @if (count($errors) > 0)
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><i class="icon fa fa-ban"></i> Notification</h4>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if(auth()->guard('customer')->check())
                                    <input type="hidden" name="id_customer" value="{{auth()->guard('customer')->user()->id}}">
                                @endif

                                <div class="form-group">
                                    <label for="nama_lengkap" class="control-label col-sm-3">Nama Lengkap</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nama_lengkap" value="{{auth()->guard('customer')->check() ? auth()->guard('customer')->user()->nama_lengkap : old('nama_lengkap')}}" {{auth()->guard('customer')->check() ? 'readonly' : ''}} class="form-control" id="nama_lengkap" required>
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label for="no_hp" class="control-label col-sm-3">No Handphone</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="no_hp" value="{{auth()->guard('customer')->check() ? auth()->guard('customer')->user()->no_hp : old('no_hp')}}" {{auth()->guard('customer')->check() ? 'readonly' : ''}} class="form-control" id="no_hp" required>
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label for="email" class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" class="form-control" value="{{auth()->guard('customer')->check() ? auth()->guard('customer')->user()->email : old('email')}}" {{auth()->guard('customer')->check() ? 'readonly' : ''}}  id="email" required>
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label for="bbm" class="col-sm-3 control-label">PIN BBM (optional)</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="pinbbm" value="{{auth()->guard('customer')->check() ? auth()->guard('customer')->user()->bbm : old('bbm')}}" {{auth()->guard('customer')->check() ? 'readonly' : ''}}  class="form-control" id="bbm">

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">INFORMASI ALAMAT</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="alamat" id="alamat"  class="form-control" rows="6"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Provinsi</label>
                                    <select class="form-control" name="provinsi" id="provinsi" required>
                                        <option value="0">Pilih</option>
                                        @for ($i=0; $i<count($provinsi); $i++)
                                            <option value="{{ $provinsi[$i]['province_id'] }}">{{ $provinsi[$i]['province'] }}</option>
                                        @endfor
                                    </select>
                                    <input type="hidden" name="province" id="province" required>
                                </div>


                                <div class="form-group">
                                    <label>Kota</label>
                                    <select class="form-control" name="kota" id="kota" required >
                                        <option value="0">Pilih</option>
                                    </select>
                                    <input type="hidden" name="city" id="city" required>

                                </div>

                                <div class="form-group">
                                    <div>JNE *</div>
                                    <select class="form-control" name="jne" id="jne">
                                        <option value="0">Pilih</option>
                                    </select>
                                </div>
                                <div class="form-group">

                                    <label>Kode POS</label>
                                    <input type="text" name="kode_pos" class="form-control" id="kode_post" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @else
                <div class="alert alert-danger" role="alert">
                    <p>Belum ada barang yang ditambahkan ke keranjang belanja. <a href="{{ url('/') }}" class="btn btn-default btn-sm">Kembali</a></p>
                </div>
                
            @endif
        </div>
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5>Konfirmasi Pesanan</h5>
                </div>
                <div class="panel-body">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Product</th>
                                <th>Qty</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($cart as $item)
                            <tr>
                                <td>
                                    @if ($item->options->name_photo != "")
                                        <img src="{{ asset('upload/img/' . $item->options->name_photo) }}" alt="{{ $item->name }}" class="img-responsive thumbnail" style="min-height: 25px; height: 50px; min-width: 20px; width: 50px;">
                                    @else
                                        <img src="{{ asset('img/not-available.jpg') }}" alt="{{ $item->name }}" class="img-responsive thumbnail" style="min-height: 25px; height: 50px; min-width: 20px; width: 50px;">
                                    @endif
                                    
                                </td>
                                <td>
                                    <p><strong>{{ $item->name }}</strong></p>
                                </td>
                                <td>
                                    <p>{{ $item->qty }}</p>
                                </td>
                                <td>
                                    <p><strong>{{ $item->subtotal }}</strong></p>
                                    {{ Form::hidden('berat', $item->options->totalberat, ['class' => 'form-control berat'] ) }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pull-right">
                        <p>Sub Total : <strong class="pull-right">Rp. {{ $total }}</strong></p>
                        <p id="biayapengiriman">Biaya Pengiriman : Rp. 0</p>
                        <hr>
                        <p class="pull-right" style="font-weight: bold;" id="total">Total : Rp. {{ $total }}</p>
                        <textarea class="form-control" name="catatan" placeholder="Catatan"></textarea>
                        <br>
                        <p class="pull-right">{!! Form::submit('Konfirmasi Pesanan', ['class'=>'btn btn-primary btn-sm']) !!}</p>
                    </div>
                    

                </div>


            </div>
        </div>


        {!! Form::close() !!}
    </div>
</div>

<script type="text/javascript">
    $("#provinsi").change(function() {
        var nama_province = $("#provinsi option:selected").text();
        $("#province").val(nama_province);

    });
    $("#kota").change(function() {
        var nama_kota = $("#kota option:selected").text();
        $("#city").val(nama_kota);

    });
</script>

<script type="text/javascript">
    $("#provinsi").change(function(){
        $.ajax({
            url: "/city",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf_token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
            data: { province : $("#provinsi").val() },
            dataType: 'json',
            success: function(data) {
                var city = $("#kota"), options = '';
                city.empty();

                for(var i=0;i<data.length; i++)
                {
                    options += "<option value='"+data[i].id+"'>"+ data[i].city_name +"</option>";
                }

                city.append(options);
                city.fadeIn();

            },error:function(){ 
                alert("error!!!!");
            }
        }); 
    });
</script>

<script type="text/javascript">
    $("#kota").change(function(){
        $.ajax({
            url: "/ongkir",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf_token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
            data: { destination: $("#kota").val(), weight: $(".berat").val() },
            dataType: 'json',
            success: function(data) {
                var ongkir = $("#jne"), options = '';
                ongkir.empty();

                for(var i=0;i<data.length; i++)
                {
                    options += "<option value='"+data[i].biaya+"'>"+ data[i].service + ": " + data[i].biaya + "</option>";
                }

                ongkir.append(options);
                ongkir.fadeIn();
            },error:function(){ 
                alert("Ongkir Belum tersedia, Silahkan Teruskan Orderan Anda Dan Hubungi Admin Utk Proses Selanjutnya");
            }
        }); 
    });
</script>

<script type="text/javascript">
    $("#jne").change(function(){
        var biayakirim = $("#jne").val();
        var totalorder = {{ $total }};
        var total = parseInt(biayakirim) + parseInt(totalorder);
        $("#biayapengiriman").text("Biaya Pengiriman : Rp. "+biayakirim);
        $("#total").text("Total : Rp. "+total);
    });
</script>
@endsection
