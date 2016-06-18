<table id="datatable" class="table table-striped table-hover table-responsive datatable">
    <thead>
        <tr>
            <th>##</th>
            <th>{!! trans('job.jobs-index-name_label') !!}</th>
            {{-- <th>{!! trans('job.jobs-index-content_label')!!}</th> --}}
            <th>{!! trans('job.jobs-index-slug_label') !!}</th>
            <th>{!! trans('job.jobs-index-published_at_label') !!}</th>
            <th>&nbsp;</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($jobs as $job)
            <tr>
                <th>{{$job->id}}</th>
                <td>
                    <div class="col-md-1">
                        <a href="{{route('admin.jobs.image-upload',['id'=>$job->id])}}"
                            data-toggle="tooltip"
                            data-original-title="{!! trans('job.images-upload-btnupload') !!}"
                            class="btn btn-default btn-flat  pull-right "><i class="fa fa-upload"></i></a>
                    </div>
                    {{$job->name}}
                </td>
                {{-- <td>{{$job->content}}</td> --}}
                <td>{{$job->slug}}</td>
                <td>{{$job->published_at }}</td>
                <td>
                    <div class="row">
                        <div class="col-sm-1">
                            <a href="{{route('admin.jobs.show', ['id'=>$job->id])}}"
                                data-toggle="tooltip"
                                data-original-title="{!! trans('job.jobs-view_tooltip') !!}"
                                class="btn btn-primary btn-flat"><i class="fa fa-eye"></i></a>
                        </div>
                        <div class="col-sm-1 col-sm-offset-1">
                            <a href="{{route('admin.jobs.edit',['id'=>$job->id])}}"
                                data-toggle="tooltip"
                                data-original-title="{!! trans('job.jobs-update_tooltip') !!}"
                                class="btn btn-info btn-flat"><i class="fa fa-pencil"></i></a>
                        </div>
                        <div class="col-sm-1 col-sm-offset-1">
                            {!! Form::open(['route' => ['admin.jobs.destroy', $job->id],
                            'class' => 'form-horizontal confirm',
                            'role' => 'form', 'method' => 'DELETE']) !!}
                                <button data-toggle="tooltip"
                                    data-original-title="{{trans('job.jobs-delete_tooltip') }}"
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
            <th></th>
            <th>
                <button class="btn btn-primary btn-flat" type="button">
                  {{trans('job.jobs-counter_badge') }} <span class="badge">{{count($jobs)}}</span>
                </button>
            </th>
        </tr>
    </tfoot>
</table>
