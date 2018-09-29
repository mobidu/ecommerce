@extends('layouts.master')

@section('title')
<title>Kategori | {{ $pengaturan->nama_toko }}</title>
<meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection

@section('plugin')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
	<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Data Category<small></small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Katalog</a></li>
            <li class="active">Data Kategori</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

      	<div class="col-md-4">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                	<h4>Tambah Kategori</h4>
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

                	{!! Form::open(array('url'=>'/admin/category', 'class'=>'form-horizontal')) !!}
	                	<div class="form-group">
	                      {!! Form::label('nama_kategori', 'Nama', ['class'=>'col-sm-offset-1 control-label']) !!}
	                      <div class="col-sm-12"> 
	                      	{!! Form::text('nama_kategori', null, ['class'=>'form-control', 'id'=>'nama_kategori', 'required'=>'required']) !!}
	                      </div>
	                    </div>

	                    <div class="form-group">
	                      {!! Form::label('slug', 'Slug', ['class'=>'col-sm-offset-1 control-label']) !!}
	                      <div class="col-sm-12"> 
	                      	{!! Form::text('slug', null, ['class'=>'form-control', 'id'=>'slug', 'readonly'=>'readonly']) !!}
	                      	<p id="pesan"></p>
	                      </div>
	                    </div>

	                    <div class="form-group">
	                      {!! Form::label('deskripsi', 'Deskripsi', ['class'=>'col-sm-offset-1 control-label']) !!}
	                      <div class="col-sm-12"> 
	                      	{!! Form::textarea('deskripsi', null, ['class'=>'form-control', 'id'=>'deskripsi', 'cols'=>'30', 'rows'=>'5']) !!}
	                      </div>
	                    </div>
	                    
	                    <div class="form-group">
	                    	<label></label>
		                  	<div class="col-sm-12">
		                    	{!! Form::submit('Tambah', ['class'=>'btn btn-primary', 'id'=>'simpan']) !!}
		                    </div>
	                  	</div>
	                {!! Form::close() !!}


                </div><!-- /.box-body -->
            </div><!-- /.box -->

            
        </div><!-- /.col -->

        <div class="col-md-8">
            <div class="box">
                <div class="box-header">
            	    <h3 class="box-title"></h3>
                </div><!-- /.box-header -->
                
                <div class="table-responsive">
					<table class="table table-striped table-bordered display" id="kategori">
				    	<thead>
				    		<tr>
					    		<th>Nama</th>
					    		<th>Deskripsi</th>
					    		<th>Slug</th>
					    		<th>Aksi</th>
				    		</tr>
				    	</thead>
				    	<tbody>
				    	
				    	@foreach ($kategori as $item)
				    		<tr>
					    		<td>{{ $item->nama_kategori }}</td>
					    		<td>{{ $item->deskripsi }}</td>
					    		<td>{{ $item->slug }}</td>
					    		<td>
					    			{{ Form::open(array('method'=>'DELETE', 'route'=>array('kategori.destroy', $item->id))) }}
					    			{{ Form::submit('Hapus', array('class'=>'btn btn-danger btn-sm')) }}
					    			{{ Form::close() }}
					    		</td>
				    		</tr>
				    	@endforeach

				    	</tbody>
				    </table>
				   
				</div>

            </div><!-- /.box -->
        </div><!-- /.col -->
    	</div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
    $("#nama_kategori").focusout(function(){
        $.ajax({
            url: "/admin/category/slug",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf_token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
            data: { nama_kategori : $("#nama_kategori").val() },
            dataType: 'json',
            success: function(data) {
                var slug = $("#slug");

                if (data.pesan == 0) {
                	$("#pesan").text("");
                	$("#simpan").prop("disabled", false);
                	slug.val(data.nama_kategori);
                } else {
                	$("#pesan").text("Already Exist!");
                	$("#pesan").css("color", "red");
                	$("#simpan").prop("disabled", true);
                }
                
            },error:function(){ 
                alert("error!!!!");
            }
        }); 
    });
</script>

<script>
    $(function() {
      $("#kategori").DataTable({
     		columnDefs: [ { 
     			"visible": false, "orderable": false
     		}]
  		});
    });
</script>
@endsection