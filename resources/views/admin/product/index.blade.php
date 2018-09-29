@extends('layouts.master')

@section('title')
	<title>Produk | {{ $pengaturan->nama_toko }}</title>
	<meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection

@section('plugin')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
	{{--<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">--}}
	<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Data Produk<small></small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Product</a></li>
            <li class="active">Data Product</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
            	    <div class="pull-right"> 
				    	<a href="{{ url('/admin/product/create') }}"><button class="btn btn-primary btn-sm">Tambah Produk</button></a>
				    </div>

                </div><!-- /.box-header -->
                
               
                <div class="box-body">
					<div class="table-responsive">

						<table class="table table-striped table-bordered display" id="produk">
							<thead>
							<tr>
								<th>Kode</th>
								<th>Photo</th>
								<th>Title</th>
								<th>Category</th>
								<th>Stock</th>
								<th>Price</th>
								<th>Date Created</th>
								<th>Published</th>
								<th></th>
							</tr>
							</thead>
							<tbody>

							@foreach ($product as $item)
								<tr>
									<td>{{ $item->kode_produk }}</td>
									@if ($item->media_image_id != null)
										<td><a href="{{ url('/admin/product/' . $item->id . '/edit') }}"><img class="img-thumbnail img-responsive" src="{{ asset('upload/img/' . $item->media_image->name_photo . '') }}" width="70"></a></td>
									@else
										<td><a href="{{ url('/admin/product/' . $item->id . '/edit') }}"><img class="img-thumbnail img-responsive" src="{{ asset('img/not-available.jpg') }}" width="70"></a></td>
									@endif
									<td><a href="{{ url('/admin/product/' . $item->id . '/edit') }}"><strong>{{ $item->nama_produk }}</strong></a></td>
									<td>{{ $item->category->nama_kategori }}</td>
									<td>{{ $item->stok }}</td>
									<td>{{ $item->harga }}</td>
									<td>{{ $item->created_at }}</td>
									<td>
										@if ($item->publish == 1)
											<span class="label label-success">Active</span>
										@else
											<span class="label label-warning">Draft</span>
										@endif
									</td>
									<td>
										{{ Form::open(array('url'=>'/admin/product/' . $item->id, 'method'=>'DELETE')) }}
										<button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
										{{ Form::close() }}
									</td>

								<!--
					    		<td>
					    			{{ Form::open(array('method'=>'DELETE', 'route'=>array('product.destroy', $item->id))) }}
								{{ Form::submit('Delete', array('class'=>'btn btn-danger btn-sm')) }}
								{{ Form::close() }}
										</td>-->
								</tr>
							@endforeach

							</tbody>
						</table>
					</div>
				</div>

            </div><!-- /.box -->
        </div><!-- /.col -->
    	</div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<script>
    $(function() {
      $("#produk").DataTable({
     		columnDefs: [ { 
     			"visible": false, "orderable": false
     		}]
  		});
    });
</script>
@endsection