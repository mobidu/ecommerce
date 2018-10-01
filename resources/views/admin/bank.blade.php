@extends('layouts.master')

@section('title')
<title>Payment Method | {{ $pengaturan->nama_toko }}</title>
<meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection

@section('plugin')
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">
	<script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
	<script src="//cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Data Bank<small></small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Bank</a></li>
            <li class="active">Data Bank</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

      	<div class="col-md-4">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                	<h4>Metode Pembayaran</h4>
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


                    <form action="{{url('/admin/payment')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
	                	<div class="form-group">
                            <label for="nama_pemilik" class="col-sm-4 control-label">Nama Pemilik *</label>
                            <div class="col-sm-8">
                                <input type="text" name="nama_pemilik" class="form-control" id="nama_pemilik" placeholder="Masukan Nama Pemilik" required>
                            </div>

	                    </div>

                        <div class="form-group">
                            <label for="no_rekening" class="control-label col-sm-4">No Rekening</label>
                            <div class="col-sm-8">
                                <input type="text" name="no_rekening" class="form-control" id="no_rekening" placeholder="Masukan Nomor Rekening" required>
                            </div>

                        </div>

	                    <div class="form-group">
                            <label for="id_bank" class="control-label col-sm-4">Pilih Bank</label>
                            <div class="col-sm-8">

                                <select name="id_bank" class="form-control" id="nama_bank" required="">
                                    <option value="">Silahkan Pilih</option>
                                    @forelse($bank_provider as $b)
                                        <option value="{{$b->id}}">{{$b->kode.' | '.$b->nama}}</option>

                                    @empty

                                    @endforelse
                                </select>
                            </div>
	                    </div>
                    
	                    <div class="form-group">
	                    	<label class="col-sm-4"></label>
		                  	<div class="col-sm-8">
                                <button class="btn btn-primary btn-block" type="submit">Simpan</button>

		                    </div>
	                  	</div>
                    </form>


                </div><!-- /.box-body -->
            </div><!-- /.box -->

            
        </div><!-- /.col -->

        <div class="col-md-8">
            <div class="box">
                <div class="box-header">
            	    <h3 class="box-title"></h3>
                </div><!-- /.box-header -->
                
                <div class="table-responsive">
					<table class="table table-striped table-bordered display" id="bank">
				    	<thead>
				    		<tr>
					    		<th>Nama Pemilik</th>
					    		<th>No Rekening</th>
					    		<th>Nama Bank</th>
                                <th>Kode Bank</th>
					    		<th>Action</th>
				    		</tr>
				    	</thead>
				    	<tbody>
				    	@foreach ($bank as $item)
				    		<tr>
					    		<td>{{ $item->nama_pemilik }}</td>
					    		<td>{{ $item->no_rekening }}</td>
					    		<td>{{ $item->provider ? $item->provider->nama : '' }}</td>
                                <td>{{ $item->provider ? $item->provider->kode : ''}}</td>
					    		<td>
					    			{{ Form::open(array('method'=>'DELETE', 'route'=>array('payment.destroy', $item->id))) }}
					    			{{ Form::submit('Delete', array('class'=>'btn btn-danger btn-sm')) }}
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

<script>
    $(function() {
      $("#bank").DataTable({
     		columnDefs: [ { 
     			"visible": false, "orderable": false
     		}]
  		});
    });
</script>
@endsection