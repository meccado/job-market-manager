@extends('admin.layouts.admin-master')

@section('title')
     {{-- this page title --}}
     {!!(isset($title)) ? $title : 'Article Tags'!!}
@stop

@section('styles')
   {{-- this page specialised styles --}}
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ URL::asset('assets/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css')}}">
@stop

@section('content')

    <p>{!! link_to_route('admin.job_tags.create', trans('tag.tags-index-add_new'), [], ['class' => 'btn btn-success btn-flat'])
    !!}</p>

    @if(count($job_tags) > 0)
        <div class="box box-primary"><!-- .box -->
            <div class="box-header with-border"><!-- .box-header -->

                <h3 class="box-title pull-left">
                    {{ trans('tag.tags-index-tags_list') }}
                </h3>
            </div><!-- /.box-header -->

            <div class="box-body"><!-- box-body -->
                @include('admin.job_tags._table')
            </div><!-- /.box-body -->

            <div class="box-footer"><!-- .box-footer-->
              {{ trans('tag.tags-index-footer') }}
            </div><!-- /.box-footer-->

        </div><!-- /.box -->

    @else
        {{ trans('tag.tags-index-no_entries_found') }}
    @endif

@endsection

@section('scripts')
   {{-- this page specialised scripts --}}
   <!-- DataTables -->
    <script src="{{ URL::asset('assets/bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript">
     $(document).ready(function(){
         $('[data-toggle="tooltip"]').tooltip();
     });
    </script>
@stop
