@extends('layouts.master')

@section('title')
	<title>Pages | {{ $pengaturan->nama_toko }}</title>
	<meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection

@section('plugin')
	<style type="text/css">
	.ui-autocomplete { max-height: 200px; max-width: 300px; overflow-y: scroll; overflow-x: hidden;}
	#errpersen {
		color: red;
	}
	.errkode { color: red; }
	</style>

	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Data Pages<small></small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Pages</a></li>
            <li class="active">Add New Page</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">


		<form action="{{url('/admin/pages/create')}}" class="form-horizontal" method="post">
			{{csrf_field()}}
			<div class="col-md-12">

				<!-- Profile Image -->
				<div class="box box-primary">
					<div class="box-body box-profile">
						<h4>Add New Page</h4>
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

								<label for="judul" class="control-label col-sm-3">Judul *</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="judul" name="judul" required placeholder="Masukan Judul Page">
								</div>
							</div>

							<div class="form-group">
								<label for="slug" class="control-label col-sm-3">Slug *</label>
								<div class="col-sm-9">
									<input type="text" name="slug" class="form-control" id="slug">
								</div>
							</div>

							<div class="form-group">

								<label for="content" class="control-label col-sm-3">Konten *</label>
								<div class="col-sm-9">
									<textarea name="content" class="form-control" id="konten" rows="10" cols="80" ></textarea>
								</div>
							</div>

							<div class="form-group">
								<label></label>
								<div class="col-sm-9 pull-right">
									<button type="submit" class="btn btn-primary" id="simpan">Tambah</button>
								</div>
							</div>

					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div><!-- /.col -->
		</form>

    	</div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    $(function(){
        $("#konten").summernote( {
            height: 200, toolbar: [ // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']], ['insert', ['picture', 'video', 'link', 'table']], ['font', ['strikethrough', 'superscript', 'subscript']], ['fontsize', ['fontsize']], ['color', ['color']], ['para', ['ul', 'ol', 'paragraph']], ['height', ['height']], ['misc', ['fullscreen']], ],
        });
    });
</script>

@endsection

@section('script')
	<script src="{{url('/plugins/summernote/dist/summernote.js')}}" type="text/javascript"></script>
@endsection
@section('style')
	<link rel="stylesheet" href="{{url('/plugins/summernote/dist/summernote.css')}}">
@endsection