@extends('layouts.front')

@section('title')
    <title>Konfirmasi Pembayaran | {{ $pengaturan->nama_toko }}</title>
    <meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                    <li class="active">Konfirmasi Pembayaran</li>
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
                    <div class="panel panel-default">
                        <div class="panel-heading">Form Konfirmasi Pembayaran</div>
                            <div class="panel-body">
                                <form action="{{url('/konfirmasi-pembayaran')}}" method="post" enctype="multipart/form-data">

                                {{csrf_field()}}
                                @if (session('status'))
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="glyphicon glyphicon-info-sign"></i> Pemberitahuan</h4>
                                    <p>{{ session('status') }}</p>
                                </div>
                                @elseif (count($errors) > 0)
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

                                <div class="form-group">
                                    <label for="incoice">#InvoiceID</label>

                                    <input type="text" class="form-control" name="invoice" id="invoice" required>
                                    <p id="pesan"></p>
                                </div>

                                <div class="form-group">
                                    <label for="nama_pemilik" >Nama Pengirim *</label>
                                    <input type="text" name="nama_pemilik" class="form-control" id="nama_pemilik" required />
                                </div>

                                <div class="form-group">
                                    <label for="bank_from" class="control-label col-sm-3">Dari Bank *</label>
                                    <input type="text" class="form-control" name="bank_from">
                                </div>

                                <div class="form-group">
                                    <label for="no_rekening">No Rekening *</label>
                                      <input type="text" name="no_rekening" id="no_rekening" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="bak_to">Bank Tujuan *</label>
                                    <select name="bank_to" class="form-control" id="bank_to">
                                        <option value="">Pilih</option>
                                        @foreach ($bank as $b)
                                            <option value="{{ $b->nama_bank }}">{{ $b->nama_bank }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="jumlah">Jumlah *</label>
                                    <input type="number" class="form-control" name="jumlah" id="jumlah" required>
                                </div>

                                <div class="form-group">
                                    <label for="bukti_transfer">Bukti Transfer *</label>
                                    <input type="file" name="bukti_transfer" id="bukti_transfer" required="">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" id="simpan" disabled>Konfirmasi Pembayaran</button>
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

<script type="text/javascript">
    $("#invoice").focusout(function(){
        $.ajax({
            url: "{{ route('pembayaran.cekinvoice') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf_token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
            data: { invoice : $("#invoice").val() },
            dataType: 'json',
            success: function(data) {
                var invoice = $("#invoice");

                if (data.pesan == 0) {
                    $("#pesan").text("Invoice Tidak Ditemukan");
                    $("#pesan").css("color", "red");
                    $("#simpan").prop("disabled", true);
                } else {
                    $("#pesan").text("Invoice Ditemukan");
                    $("#pesan").css("color", "green");
                    $("#simpan").prop("disabled", false);
                }
                
            },error:function(){ 
                alert("error!!!!");
            }
        }); 
    });
</script>

@endsection