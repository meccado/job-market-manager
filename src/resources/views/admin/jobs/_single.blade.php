<div class="col-md-12">
    <div class="col-md-12" id="job_template">
        <div class="dropzone-previews"></div>
        {!! Form::open(['route'     => ['admin.jobs.upload', $job->id],
                        'method'	=>'POST',
                        'class'		=>'dropzone',
                        'id'		  =>'job_dropzone',
                        'files'		=>'true',

                    ])
        !!}
        {!! Form::close() !!}
    </div>
</div>
