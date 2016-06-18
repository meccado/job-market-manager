<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Meccado\JobMarketManager\Http\Requests\JobFormRequest as JobFormRequest;
use Meccado\JobMarketManager\Http\Requests\ImageFormRequest as ImageFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input as Input;
use App\Job as Job;
use App\JobCategory as JobCategory;
use App\JobTag as JobTag;
use Illuminate\Support\Facades\File as File;
use Image as Image;

class JobController extends Controller
{

  /**
  * @var JobTag
  */
  protected $jobs;

  public function __construct(Job $jobs)
  {
    $this->jobs = $jobs;
  }
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $jobs =  $this->jobs->latest('published_at')
    ->published()
    ->get();
    //$jobs = Job::with('Categories')->get();
    return view('admin.jobs.index',['jobs' => $jobs]);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $category_items = JobCategory::lists('name', 'id')->toarray();
    $tag_items = JobTag::lists('name', 'id')->toarray();
    $categories_selected = [];
    $tags_selected = [];
    return view('admin.jobs.store', compact('category_items', 'categories_selected', 'tag_items', 'tags_selected'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(JobFormRequest $request)
  {
    $job = $this->jobs->create([
      'name'              => $request->get('name'),
      'purpose'           => $request->get('purpose'),
      'experience'        => $request->get('experience'),
      'content'           => $request->get('content'),
      'start_range'       => $request->get('start_range'),
      'end_range'         => $request->get('end_range'),
      'slug'              => str_slug($request->get('slug')),
      'published'         => $request->input('published') === 'on' ? true : false,
      'published_at'      => $request->input('published_at'),
      'expiration_at'     => $request->input('expiration_at'),
    ]);
    $job->save();
    foreach ($request->categories as $index =>$category_id) {
      $category = JobCategory::whereId($category_id)->first();
      $job->assignCategory($category);
    }

    foreach ($request->tags as $index =>$tag_id) {
      $tag = JobTag::whereId($tag_id)->first();
      $job->assignTag($tag);
    }

    return \Redirect::route('admin.jobs.index')->with('flash_message', 'Job added!');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show(Job $jobs)
  {
    //$job = $this->jobs->findOrFail($id);
    return view('admin_article::admin.jobs.show', ['job' => $jobs]);
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $job = $this->jobs->findOrFail($id);
    $categories_selected = $job->categories->lists('id')->toarray();
    $tags_selected = $job->tags->lists('id')->toarray();
    $tag_items = JobTag::lists('name', 'id')->toarray();
    $category_items = JobCategory::lists('name', 'id')->toarray();
    return view('admin.jobs.update', compact('job', 'tags_selected', 'categories_selected', 'category_items', 'tag_items'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(JobFormRequest $request, $id)
  {
    $job = $this->jobs->whereId($id)->first();
    $job->categories()->detach();
    $job->tags()->detach();
    $job->name              = $request->get('name');
    $job->purpose           = $request->get('purpose');
    $job->experience        = $request->get('experience');
    $job->content           = $request->get('content');
    $job->start_range       = $request->get('start_range');
    $job->end_range         = $request->get('end_range');
    $job->slug              = str_slug($request->get('slug'));
    $job->published         = $request->input('published') === 'on' ? true : false;
    $job->published_at      = $request->input('published_at');
    $job->expiration_at     = $request->input('expiration_at');
    $job->update();
    foreach ($request->categories as $index =>$category_id) {
      $category = JobCategory::whereId($category_id)->first();
      $job->assignCategory($category);
    }

    foreach ($request->tags as $index =>$tag_id) {
      $tag = JobTag::whereId($tag_id)->first();
      $job->assignTag($tag);
    }
    return \Redirect::route('admin.jobs.index')->with('flash_message', 'Job added!');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $job = $this->jobs->findOrFail($id);
    if($job){
      $job->delete();
      return \Redirect::to('admin/jobs')
      ->with('flash_message', 'Job Deleted');
    }
    return \Redirect::to('admin/jobs')
    ->with('flash_message', 'Something went wrong, please try again');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function getUpload($id)
  {
    $job = $this->jobs->findOrFail($id);
    return \View::make('admin.jobs.upload')->with(compact('job'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function upload(ImageFormRequest $request, $id)
  {
    if(Input::hasFile('file')) {
      $file = $request->file('file');
      $filename = uniqid() . $file->getClientOriginalName();
      $original = public_path('assets\images\jobs\original\\'.$filename);
      $thumbnail = public_path('assets\images\jobs\thumbnail\\'.$filename);
      $resize = public_path('assets\images\jobs\resize\\'.$filename);
      if (!File::exists(public_path('assets\images\jobs\original')))
      {
        File::makeDirectory(public_path('assets\images\jobs\original'), $mode = 0777, true, true);
        if (!File::exists(public_path('assets\images\jobs\thumbnail'))){File::makeDirectory(public_path('assets\images\jobs\thumbnail'), $mode = 0777, true, true);}
        if (!File::exists(public_path('assets\images\jobs\resize'))){File::makeDirectory(public_path('assets\images\jobs\resize'), $mode = 0777, true, true);}
      }
      // upload new image
      $img = Image::make($file->getRealPath());
      $img->save($original);// original
      $img->fit('150', '150'); // thumbnail (grab)
      $img->save($thumbnail);
      $img->resize('300', '300'); // resize and set true if you want proportional image resize
      $img->save($resize);
      $img->destroy();
      $job = $this->jobs->find($id);
      $image = $job->images()->create([
        'job_id'   => $request->input('job_id'),
        'file_name'     => $filename,
        'file_size'     => $file->getClientSize(),
        'file_mime'     => $file->getClientMimeType(),
        'file_path'     => '/assets/images/jobs/original/'.$filename,
        'created_by'    => \Auth::user() ? \Auth::user()->id : 0,
      ]);
      return response()->json($image, 200);
    }else{
      return response()->json(false, 200);
    }
  }
}
