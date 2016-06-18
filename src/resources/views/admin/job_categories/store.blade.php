@extends('admin.layouts.admin-master')

@section('title')
     {{-- this page title --}}
     {!!(isset($title)) ? $title : 'Job Category'!!}
@stop

@section('content')
   <p>
     {!! link_to_route('admin.job_categories.index', trans('category.categories-index-add_index'), [], ['class' => 'btn btn-default btn-flat']) !!}
   </p>
	<div class="box box-primary"><!-- .box -->
		<div class="box-header with-border"><!-- .box-header -->
			<h3 class="box-title pull-left">
				{{ trans('category.categories-create-create_category') }}
			</h3>
		</div><!-- /.box-header -->

		<div class="box-body"><!-- .box-body -->
			<div class="row">
		        <div class="col-sm-10 col-sm-offset-2">
		            @include('errors.error')
		        </div>
		    </div>

		    @include('admin.job_categories._form')
		</div><!-- /.box-body -->

		<div class="box-footer"><!-- .box-footer-->
			  {{ trans('category.categories-create-footer') }}
		</div><!-- /.box-footer-->
	</div><!-- /.box -->

@endsection
