@if(isset($job_category))
  {!! Form::model($job_category,
    ['route'     => ['admin.job_categories.update', $job_category->id],
    'method'     => 'PUT',
    'class'      => 'form-horizontal',
    'files'      => true])
    !!}
  @else
    {!! Form::open(['route' =>'admin.job_categories.store',
      'method' =>'POST',
      'class'  =>'form-horizontal',
      'files'  =>'true',
    ])
    !!}
  @endif

  <fieldset>
    <!-- Name Form Input -->
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
      {!!Form::label('name', 'Name', ['class'=>'col-md-3 control-label'])!!}
      <div class="col-md-9">
        {!!Form::text('name', old('name'),array('required','class' => 'form-control ','placeholder'=>'Type category here ..','max-length'=>'50'))!!}
        @if ($errors->has('name'))
          <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
          </span>
        @endif
      </div>
    </div>
    <!-- Sort Order Form Input -->
    <div class="form-group{{ $errors->has('sort_order') ? ' has-error' : '' }}">
      {!!Form::label('sort_order', 'Sort Order', ['class'=>'col-md-3 control-label'])!!}
      <div class="col-md-9">
        {!!Form::input('number', 'sort_order', old('sort_order'),array('required','class' => 'form-control ','placeholder'=>'Enter sort order of image slides','max-length'=>'50'))!!}
        @if ($errors->has('sort_order'))
          <span class="help-block">
            <strong>{{ $errors->first('sort_order') }}</strong>
          </span>
        @endif
      </div>
    </div>
    <!-- Parent Category Form Input -->
      <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
        {!!Form::label('parent_id', 'Parent Category', ['class'=>'col-md-3 control-label'])!!}
        <div class="col-md-9">
          {!! Form::select('parent_id', ['' => '<Select Category ... >', '0' => 'Parent Category' ] +  $items, old('parent_id'), ['class' => 'form-control']) !!}
            @if ($errors->has('parent_id'))
              <span class="help-block">
                <strong>{{ $errors->first('parent_id') }}</strong>
              </span>
            @endif
          </div>
        </div>
        <!-- SEO Description Form Input -->
        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
          {!!Form::label('description', 'Description', ['class'=>'col-md-3 control-label'])!!}
          <div class="col-md-9">
            {!!Form::textArea('description', null,array('required','class' => 'form-control','placeholder'=>'Enter detail information of category','max-length'=>'250'))!!}
            @if ($errors->has('description'))
              <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
              </span>
            @endif
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
            @if (isset($job_category))
              {!! Form::button('<i class="fa fa-btn fa-save"></i> Update Category Item!', ['type'=>'submit', 'class' =>'btn btn-primary']) !!}
            @else
              {!! Form::button('<i class="fa fa-btn fa-save"></i> Save Category Item!', ['type'=>'submit', 'class' =>'btn btn-primary']) !!}
            @endif
          </div>
        </div>
      </fieldset>
      {!! Form::close() !!}
