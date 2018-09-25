@extends('layouts.master')

@section('title')
	<title>Edit Product | {{ $pengaturan->nama_toko }}</title>
	<meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection

@section('plugin')
	<style type="text/css">
	.ui-autocomplete { max-height: 200px; max-width: 300px; overflow-y: scroll; overflow-x: hidden;}
	#errpersen {
		color: red;
	}
	.errkode { color: red; }
	#hapus_gambar:hover { color: red; }
	</style>

	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script>
	<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Data Product<small></small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Product</a></li>
            <li class="active">New Product</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

        {!! Form::model($product, array('url'=>'/admin/product/' . $product->id, 'class'=>'form-horizontal', 'files' => true, 'method'=>'PUT')) !!}
      	<div class="col-md-8">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                	<h4>Add New Product</h4>
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
                	<hr>
                	
	                	<div class="form-group">
	                      {!! Form::label('nama_produk', 'Title Product *', ['class'=>'control-label col-sm-3']) !!}
	                      <div class="col-sm-9"> 
	                      	{!! Form::text('nama_produk', null, ['class'=>'form-control', 'id'=>'nama_produk', 'required'=>'required']) !!}
	                      	<p id="pesan"></p>
	                      </div>
	                    </div>

	                    <div class="form-group">
	                      {!! Form::label('slug', 'Slug', ['class'=>'control-label col-sm-3']) !!}
	                      <div class="col-sm-9"> 
	                      	{!! Form::text('slug', null, ['class'=>'form-control', 'id'=>'slug', 'readonly'=>'readonly']) !!}
	                      	
	                      </div>
	                    </div>

	                    <div class="form-group">
	                      {!! Form::label('kode_produk', 'Code Product *', ['class'=>'control-label col-sm-3']) !!}
	                      <div class="col-sm-9"> 
	                      	{!! Form::text('kode_produk', null, ['class'=>'form-control', 'id'=>'kode_produk', 'readonly'=>'readonly']) !!}
	                      		<div class="errkode"></div>
	                      </div>
	                    </div>

	                    <div class="form-group">
	                      {!! Form::label('kategori_id', 'Category', ['class'=>'control-label col-sm-3']) !!}
	                      <div class="col-sm-9"> 
	                      	<select class="form-control" name="kategori_id" id="kategori_id" style="width: 100%">
	                      		<option value=""></option>
			                    @foreach ($kategori as $kategori)
			                    	<option <?php echo $product->kategori_id == $kategori->id ? 'selected="selected"':'' ?> value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
			                    @endforeach
		                    </select>
	                      </div>
	                    </div>

	                    <div class="form-group">
	                      {!! Form::label('supplier_id', 'Category', ['class'=>'control-label col-sm-3']) !!}
	                      <div class="col-sm-9"> 
	                      	<select class="form-control" name="supplier_id" id="supplier_id" style="width: 100%">
	                      		<option value=""></option>
			                    @foreach ($supplier as $supplier)
			                    	<option <?php echo $product->supplier_id == $supplier->id ? 'selected="selected"':'' ?> value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
			                    @endforeach
		                    </select>
	                      </div>
	                    </div>

	                    <div class="form-group">
	                      {!! Form::label('deskripsi', 'Description', ['class'=>'control-label col-sm-3']) !!}
	                      <div class="col-sm-9"> 
	                      	<textarea name="deskripsi" class="form-control" id="deskripsi" rows="10" cols="80" >
				                {{ $product->deskripsi }}
				            </textarea>
	                      </div>
	                    </div>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

        <div class="col-md-4">
            <div class="box box-success box-solid">
                <div class="box-header with-border">
            	    <h3 class="box-title"><i class="fa fa-money"></i> Price of Product</h3>
                	<div class="box-tools pull-right">
                    	<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  	</div><!-- /.box-tools -->
                </div><!-- /.box-header -->


                <div class="box-body">

                	<div class="form-group">
		                {!! Form::label('publish', 'Publish', ['class'=>'control-label col-sm-3']) !!}
		                <div class="col-sm-9"> 
		                  	<select name="publish" class="form-control" id="publish">
		                  		<option <?php echo $product->publish == 1 ? 'selected="selected"':'' ?> value="1">Publish</option>
		                  		<option <?php echo $product->publish == 0 ? 'selected="selected"':'' ?> value="0">Save Draft</option>
		                  	</select>
		                </div>
	            	</div>

	            	<hr>
                  	
                  	<div class="form-group">
		                {!! Form::label('harga', 'Price (Rp) *', ['class'=>'control-label col-sm-3']) !!}
		                <div class="col-sm-9"> 
		                  	{!! Form::text('harga', null, ['class'=>'form-control', 'id'=>'harga', 'required'=>'required']) !!}	
		                </div>
	            	</div>

	            	<hr>
	            	
	            	<div class="form-group">
		                {!! Form::label('diskon', 'Discount %', ['class'=>'control-label col-sm-3']) !!}
		                <div class="col-sm-9"> 
		                  	{!! Form::text('diskon', null, ['class'=>'form-control', 'id'=>'diskon', 'required'=>'required']) !!}
		                	<p id="errpersen"></p>
		                </div>
	            	</div>

	            	<div class="form-group">
		                {!! Form::label('hemat', 'Saving (Rp)', ['class'=>'control-label col-sm-3']) !!}
		                <div class="col-sm-9"> 
		                	<?php
		                		$hemat = $product->harga * $product->diskon / 100;
		                	?>
		                  	{!! Form::text('hemat', $hemat, ['class'=>'form-control', 'id'=>'hemat', 'readonly'=>'readonly']) !!}
		                	
		                </div>
	            	</div>

	            	<hr>

	            	<div class="form-group">
		                {!! Form::label('harga_jual', 'Selling Price', ['class'=>'control-label col-sm-3']) !!}
		                <div class="col-sm-9"> 
		                  	{!! Form::text('harga_jual', null, ['class'=>'form-control', 'id'=>'harga_jual', 'readonly'=>'readonly']) !!}
		                </div>
	            	</div>

	            	<hr>

	            	<div class="form-group">
	                    <label></label>
		                <div class="col-sm-9">
		                	{!! Form::submit('Update', ['class'=>'btn btn-primary', 'id'=>'simpan']) !!}
		                </div>
	                </div>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

        <div class="col-md-4">
            <div class="box box-success box-solid">
                <div class="box-header with-border">
            	    <h3 class="box-title"><i class="fa fa-cubes"></i> Detail</h3>
                	<div class="box-tools pull-right">
                    	<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  	</div><!-- /.box-tools -->
                </div><!-- /.box-header -->


                <div class="box-body">

                  	<div class="form-group">
		                {!! Form::label('berat', 'Weight *', ['class'=>'control-label col-sm-3']) !!}
		                <div class="col-sm-9"> 
		                  	{!! Form::text('berat', null, ['class'=>'form-control', 'id'=>'berat', 'required'=>'required']) !!}
		                  	<p>(gram)</p>
		                </div>
	            	</div>

	            	<div class="form-group">
		                {!! Form::label('stok', 'Stock *', ['class'=>'control-label col-sm-3']) !!}
		                <div class="col-sm-9"> 
		                  	{!! Form::text('stok', null, ['class'=>'form-control', 'id'=>'stok', 'required'=>'required']) !!}
		                </div>
	            	</div>

	            	<div class="form-group">
		                {!! Form::label('media_image_id', 'Picture', ['class'=>'control-label col-sm-3']) !!}
		                <div class="col-sm-9">
		                	@if ($product->media_image_id == null)
		                  		{!! Form::file('media_image_id', ['id'=>'media_image_id']); !!}
		                  	@else
			                  	<img class="img-thumbnail img-responsive" src="{{ asset('upload/img/' . $product->media_image->name_photo . '') }}" width="140" height="90" alt="" id="image_ready">
			                  	<p style="position:relative;bottom:5px;right:10px;margin:0;padding:5px 3px; cursor: pointer;color: blue;" id="hapus_gambar"><i class="fa fa-remove" style="color: red"></i> Remove</p>
		                  		
		                  		<div class="image_not_ready">
		                  		</div>
		                  	@endif
		                </div>
	            	</div>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
        {!! Form::close() !!}

    	</div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    CKEDITOR.replace( 'deskripsi' );
</script>

<script type="text/javascript">
  $('#kategori_id').select2({
  	placeholder: "Select a Category",
  	theme: "classic",
  	allowClear: true
  });

  $('#supplier_id').select2({
  	placeholder: "Select a Supplier",
  	theme: "classic",
  	allowClear: true
  });
</script>

<script type="text/javascript">
	$(document).ready(function () {
	    $("#harga").bind('keypress', function (e) {
	        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
	    });

	    $("#diskon").bind('keypress', function (e) {
	        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
	    });

	    $("#berat").bind('keypress', function (e) {
	        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
	    });

	    $("#stok").bind('keypress', function (e) {
	        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
	    });
	});
</script>


<script type="text/javascript">
	$("#diskon").keyup(function(e){
		var harga = $("#harga").val();
		var diskon = $("#diskon").val();
		var hemat = parseInt(harga) * parseInt(diskon) / 100;
		var harga_jual = parseInt(harga) - hemat;
		
		if (diskon == "" || diskon == 0) {
			$("#hemat").val(0);
			$("#harga_jual").val(harga);
		} else if (diskon > 100) {
			$("#errpersen").text("Error Discount > 100");
			$("#simpan").prop("disabled", true);
			$("#hemat").val(harga);
			$("#harga_jual").val(harga);
		} else {
			$("#hemat").val(hemat);
			$("#harga_jual").val(harga_jual);
		}	
	});
</script>

<script type="text/javascript">
	$("#harga").focusout(function(){
		$("#diskon").val(0);
		$("#hemat").val(0);
		$("#harga_jual").val($("#harga").val());
	});
</script>

<script type="text/javascript">
    $("#hapus_gambar").click(function(){
        $.ajax({
            url: "{{ route('product.hapusgambar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf_token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
            data: { media_image_id : <?php echo $product->media_image_id; ?>, data_id: <?php echo $product->id; ?> },
            dataType: 'json',
            success: function(data) {
                if (data.update_media == 1) {
                	$("#image_ready").hide(500);
                	$("#image_ready" ).remove();
                	$("#hapus_gambar").remove();
                	$(".image_not_ready").append("<input type='file' name='media_image_id' id='media_image_id'>");
                }
            }
        }); 
    });
</script>
@endsection