@if(isset($job))
  {!! Form::model($job, ['route' => ['admin.jobs.update', $job->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'files' => true]) !!}
@else
  {!! Form::open(['route' =>'admin.jobs.store', 'method' =>'POST', 'class'  =>'form-horizontal', 'files'  =>'true', ])!!}
@endif

<fieldset>
  <div class="row">
    <div class="col-md-3"
    style="
    background-color: #FFF;
    border: 1px solid;
    color: #0048E8;
    {{-- #0D4000; --}}
    font-size: 14px;
    padding: 20px;
    box-shadow: 0 0 20px #A5CF00;
    margin-left: 10px;" >

      <!-- Categories Form Input -->

      <div class="form-group">
        <div class="col-md-12">
        <span><strong>{{trans('job_market_manager::job.jobs-create-contact_person_label')}}</strong>
         {{Config::get('job.contact_person')}}</span>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12">
          <span><strong>{{trans('job_market_manager::job.jobs-create-contact_email_label')}}</strong>
          {{Config::get('job.contact_email')}}</span>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12">
        <span><strong>{{trans('job_market_manager::job.jobs-create-contact_phone_label')}}</strong>
        {{Config::get('job.contact_phone') }}</span>
        </div>
      </div>

      <!-- Sort Order Form Input -->
      <div class="form-group{{ $errors->has('start_range') ? ' has-error' : '' }}">
        {!!Form::label('start_range', trans('job_market_manager::job.jobs-create-start_range_label'), ['class'=>'col-md-4 control-label'])!!}
        <div class="col-md-8">
          {!!Form::input('number', 'start_range', old('start_range'),array('required','class' => 'form-control ','placeholder'=>'Minimun salary range','max-length'=>'50'))!!}
          @if ($errors->has('start_range'))
            <span class="help-block">
              <strong>{{ $errors->first('start_range') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <!-- Sort Order Form Input -->
      <div class="form-group{{ $errors->has('end_range') ? ' has-error' : '' }}">
        {!!Form::label('end_range', trans('job_market_manager::job.jobs-create-end_range_label'), ['class'=>'col-md-4 control-label'])!!}
        <div class="col-md-8">
          {!!Form::input('number', 'end_range', old('end_range'),array('required','class' => 'form-control ','placeholder'=>'Maximum salary range','max-length'=>'50'))!!}
          @if ($errors->has('end_range'))
            <span class="help-block">
              <strong>{{ $errors->first('end_range') }}</strong>
            </span>
          @endif
        </div>
      </div>
      <!-- Categories Form Input -->
      <div class="form-group{{ $errors->has('categories') ? ' has-error' : '' }}">
        {!!Form::label('categories', trans('job_market_manager::job.jobs-create-categories_label'), ['class'=>'col-md-4 control-label'])!!}
        <div class="col-md-8">
          {!! Form::select('categories[]', $category_items, $categories_selected, ['class' => 'form-control', 'multiple' => 'multiple']); !!}
          @if ($errors->has('categories'))
            <span class="help-block">
              <strong>{{ $errors->first('categories') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <!-- Slug Form Input -->
      <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
        {!!Form::label('slug', trans('job_market_manager::job.jobs-create-slug_label'), ['class'=>'col-md-4 control-label'])!!}
        <div class="col-md-8">
          {!!Form::text('slug', old('slug'), ['required', 'class' => 'form-control ', 'placeholder'=>'Type job slug here ..'])!!}
          @if ($errors->has('slug'))
            <span class="help-block">
              <strong>{{ $errors->first('slug') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <!-- Tag Form Input -->
      <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
        {!!Form::label('tags', trans('job_market_manager::job.jobs-create-tag_label'), ['class'=>'col-md-4 control-label'])!!}
        <div class="col-md-8">
          {!! Form::select('tags[]', $tag_items, $tags_selected, ['class' => 'form-control', 'multiple' => 'multiple']); !!}
          @if ($errors->has('tags'))
            <span class="help-block">
              <strong>{{ $errors->first('tags') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <!-- Expiration At Form Input -->
      <div class="form-group{{ $errors->has('expiration_at') ? ' has-error' : '' }} ">
        {!! Form::label('expiration_at', trans('job_market_manager::job.jobs-create-expiration_at_label') , ['class'=>'col-md-4 control-label']) !!}
        <div class="col-xs-8">
          @if(isset($job ))
            {!! Form::input('date', 'expiration_at', $job->published_at , ['class' => 'form-control']) !!}
          @else
            {!! Form::input('date', 'expiration_at', date('Y-m-d'), ['class' => 'form-control']) !!}
          @endif
          @if ($errors->has('expiration_at'))
            <span class="help-block">
              <strong>{{ $errors->first('expiration_at') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <!-- Published AT Form Input -->
      <div class="form-group{{ $errors->has('published_at') ? ' has-error' : '' }} ">
        {!! Form::label('published_at', trans('job_market_manager::job.jobs-create-published_at_label') , ['class'=>'col-md-4 control-label']) !!}
        <div class="col-xs-8">
          @if(isset($job ))
            {!! Form::input('date', 'published_at', $job->published_at , ['class' => 'form-control']) !!}
          @else
            {!! Form::input('date', 'published_at', date('Y-m-d'), ['class' => 'form-control']) !!}
          @endif
          @if ($errors->has('published_at'))
            <span class="help-block">
              <strong>{{ $errors->first('published_at') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <!-- published Form Input -->
      <div class="form-group{{ $errors->has('published') ? ' has-error' : '' }}">
        {!! Form::label('published', trans('job_market_manager::job.jobs-create-published_label') , ['class'=>'col-md-4 control-label']) !!}
        <div class="col-xs-7 col-xs-offset-1">
          <div class="checkbox icheck">
            {{Form::checkbox('published', old('published'))}}
            @if ($errors->has('published'))
              <span class="help-block">
                <strong>{{ $errors->first('published') }}</strong>
              </span>
            @endif
          </div>
        </div>
      </div>

    </div><!-- /.col -->



    <div class="col-md-8"
        style="
        background-color: #FFF;
        border: 1px solid;
        color: #0048E8;
        font-size: 14px;
        padding: 20px;
        box-shadow: 0 0 20px #A5CF00;
        margin-left: 10px;">
      <!-- Name Form Input -->
      <div class="form-group">
        {!!Form::label('name', trans('job_market_manager::job.jobs-create-title_label'), ['class'=>'control-label'])!!}
      </div>
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <div class="col-md-12">
          {{--!!Form::label('name', trans('job_market_manager::job.jobs-create-title_label'), ['class'=>'col-md-2 control-label'])!!--}}
        </div>
        <div class="col-md-12">
          {!!Form::text('name', old('name'),['required',
            'class' => 'form-control ', 'placeholder'=>"Type job's title here ..."])!!}
            @if ($errors->has('name'))
              <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group">
          {!!Form::label('purpose', trans('job_market_manager::job.jobs-create-purpose_label'), ['class'=>'control-label'])!!}
        </div>
        <!-- Job Purpose Form Input -->
        <div class="form-group{{ $errors->has('purpose') ? ' has-error' : '' }}">
          {{--!!Form::label('content', trans('job_market_manager::job.jobs-create-content_label'), ['class'=>'col-md-2 control-label'])!!--}}
          <div class="col-md-12">
            {!!Form::textArea('purpose', old('purpose'),['required', 'class' => 'form-control', 'placeholder'=>'Enter detail information for the job', 'row' => '2', 'cols' => '10'])!!}
            @if ($errors->has('purpose'))
              <span class="help-block">
                <strong>{{ $errors->first('purpose') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group">
          {!!Form::label('experience', trans('job_market_manager::job.jobs-create-experience_label'), ['class'=>'control-label'])!!}
        </div>
        <!-- Job Experience Form Input -->
        <div class="form-group{{ $errors->has('experience') ? ' has-error' : '' }}">
          {{--!!Form::label('content', trans('job_market_manager::job.jobs-create-content_label'), ['class'=>'col-md-2 control-label'])!!--}}
          <div class="col-md-12">
            {!!Form::textArea('experience', old('experience'),['required', 'class' => 'form-control', 'placeholder'=>'Enter detail information for the job', 'row' => '2', 'cols' => '10'])!!}
            @if ($errors->has('experience'))
              <span class="help-block">
                <strong>{{ $errors->first('experience') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group">
          {!!Form::label('content', trans('job_market_manager::job.jobs-create-content_label'), ['class'=>'control-label'])!!}
        </div>
        <!-- Job Content Form Input -->
        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
          {{--!!Form::label('content', trans('job_market_manager::job.jobs-create-content_label'), ['class'=>'col-md-2 control-label'])!!--}}
          <div class="col-md-12">
            {!!Form::textArea('content', old('content'),['required', 'class' => 'form-control', 'placeholder'=>'Enter detail information for the job', 'row' => '2', 'cols' => '10'])!!}
            @if ($errors->has('content'))
              <span class="help-block">
                <strong>{{ $errors->first('content') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-10">
            @if (isset($job))
              {!! Form::button('<i class="fa fa-btn fa-save"></i> Update Job Item!', ['type'=>'submit', 'class' =>'btn btn-primary btn-flat']) !!}
            @else
              {!! Form::button('<i class="fa fa-btn fa-save"></i> Save Job Item!', ['type'=>'submit', 'class' =>'btn btn-primary btn-flat']) !!}
            @endif
          </div>
        </div>

      </div><!-- /.col -->
    </div><!-- /.row -->

  </fieldset>
  {!! Form::close() !!}
