<table id="datatable" class="table table-striped table-hover table-responsive datatable">
  <thead>
    <tr>
      <th>{{ trans('tag.tags-index-name') }}</th>
      <th>&nbsp;</th>
    </tr>
  </thead>

  <tbody>
    @foreach ($job_tags as $job_tag)
      <tr>
        <td>
          {{ $job_tag->name }}
        </td>
        <td>
          <div class="row">
              <div class="col-md-2">
                <a href="{{route('admin.job_tags.edit',['id'=>$job_tag->id])}}"
                  data-toggle="tooltip"
                  data-original-title="{!! trans('tag.tags-update_tooltip') !!}"
                  class="btn btn-info btn-flat"><i class="fa fa-pencil"></i></a>
                </div>
                <div class="col-md-2">
                  {!! Form::open(['route' => ['admin.job_tags.destroy', $job_tag->id],
                    'class' => 'form-horizontal confirm',
                    'onsubmit' => 'return confirm(\'' . trans('tag.tags-index-are_you_sure') . '\');',
                    'role' => 'form', 'method' => 'DELETE']) !!}
                    <button data-toggle="tooltip"
                    data-original-title="{{trans('tag.tags-delete_tooltip') }}"
                    type="submit" class="btn btn-danger confirm-btn btn-flat">
                    <i class="fa fa-trash-o"></i>
                  </button>
                  {!! Form::close() !!}
                </div>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th>
            <button class="btn btn-primary" type="button">
              Tags <span class="badge">{{count($job_tags)}}</span>
            </button>
          </th>
        </tr>
      </tfoot>
    </table>
