@extends('admin.layouts.admin-master')

@section('content')

  <div class="row">
    <div class="col-md-3" style="background-color: #FFF; padding: 20px; box-shadow: 0 0 20px #AAA; margin-left: 10px;">
      <div class="box box-primary"><!-- .box -->
        <div class="box-header with-border"><!-- .box-header -->
          <h3 class="box-title pull-left">
            {{ trans('job.jobs-show-create_job_menu') }}
          </h3>
        </div><!-- /.box-header -->

        <div class="box-body"><!-- .box-body -->
          <div class="row">
            <div class="col-sm-12">
              @unless ($job->tags->isEmpty())
                <h5>Tag:</h5>
                <ul>
                  @foreach ($job->tags as $tag)
                    <li>{!! link_to_action('Admin\TagController@show', $tag->name, ['name' => $tag->name]) !!}</li>
                  @endforeach
                </ul>
              @endif

              @unless ($job->categories->isEmpty())
                <h5>Category:</h5>
                <ul>
                  @foreach ($job->categories as $category)
                    <li>{!! link_to_action('Admin\CategoryController@show', $category->name, ['name' => $category->name]) !!}</li>
                  @endforeach
                </ul>
              @endif
            </div>
          </div>
        </div><!-- /.box-body -->

        <div class="box-footer"><!-- .box-footer-->
          {{ trans('job.jobs-show-footer_menu') }}
        </div><!-- /.box-footer-->
      </div><!-- /.box -->

    </div><!-- /.col -->

    <div class="col-md-8" style="background-color: #FFF; padding: 20px; box-shadow: 0 0 20px #AAA; margin-left: 35px;">
      <div class="box box-primary"><!-- .box -->
        <div class="box-header with-border"><!-- .box-header -->
          <h3 class="box-title pull-left">
            {{ trans('job.jobs-show-create_job') }}
          </h3>
        </div><!-- /.box-header -->

        <div class="box-body"><!-- .box-body -->
          <div class="row">
            <div class="col-sm-12">
              <h1>{{ $job->title }}</h1>
              <job>
                {!! $job->content !!}
              </job>
            </div>
          </div>
        </div><!-- /.box-body -->
        <div class="box-footer"><!-- .box-footer-->
          {{ trans('job.jobs-show-footer') }}
        </div><!-- /.box-footer-->
      </div><!-- /.box -->

    </div><!-- /.col -->
  </div><!-- /.row -->
@endsection
