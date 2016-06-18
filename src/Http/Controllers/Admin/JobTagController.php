<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\JobTag as JobTag;

class JobTagController extends Controller
{

  /**
  * @var JobTag
  */
  protected $job_tags;

  public function __construct(JobTag $job_tags)
  {
    $this->job_tags = $job_tags;
  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\View\View
  */
  public function index()
  {
    $job_tags = $this->job_tags->get();
    return \View::make('admin.job_tags.index', compact('job_tags'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\View\View
  */
  public function create()
  {
    return \View::make('admin.job_tags.create');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\RedirectResponse
  */
  public function store(Request $request)
  {
    $this->job_tags->create($request->only('name'));
    return \Redirect::route('admin.job_tags.index')
    ->withMessage(trans('tag.tags-controller-successfully_created'));
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\View\View
  */
  public function show(JobTag $tag)
  {
    $jobs = $tag->jobs()
                    ->latest('published_at')
                    ->published()->get();
		return view('admin.jobs.index', compact('jobs'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\View\View
  */
  public function edit($id)
  {
    $job_tag = $this->job_tags->findOrFail($id);
    return \View::make('admin.job_tags.edit', compact('job_tag'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\RedirectResponse
  */
  public function update(Request $request, $id)
  {
    $this->job_tags->findOrFail($id)->update($request->only('name'));
    return \Redirect::route('admin.job_tags.index')
    ->withMessage(trans('tag.tags-controller-successfully_updated'));
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\RedirectResponse
  */
  public function destroy($id)
  {
    $this->job_tags->findOrFail($id)->delete();
    return \Redirect::route('admin.job_tags.index')
    ->withMessage(trans('tag.tags-controller-successfully_deleted'));
  }
}
