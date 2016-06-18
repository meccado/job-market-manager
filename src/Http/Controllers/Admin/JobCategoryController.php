<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\JobCategory as JobCategory;

class JobCategoryController extends Controller
{

  /**
  * @var Brand
  */
  protected $categories;

  public function __construct(JobCategory $categories)
  {
    $this->categories = $categories;
  }
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    //$categories = $this->categories->get();
    return \View::make('admin.job_categories.index');//->with(compact('categories'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $items = $this->categories->lists('name', 'id')->toarray();
    return \View::make('admin.job_categories.store', compact('items'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $category = $this->categories->create($request->only('name', 'description', 'parent_id', 'sort_order'));
    return \Redirect::route('admin.job_categories.index')
    ->with('message', 'Your category has been created!');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show(JobCategory $category)
  {
    $jobs =  $category->jobs()
                          ->latest('published_at')
                          ->published()->get();
    return view('admin.jobs.index', compact('jobs'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $category = $this->categories->findOrFail($id);
    $items = $this->categories->lists('name', 'id')->toarray();
    return \View::make('admin.job_categories.update', compact('category', 'items'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    $this->categories->findOrFail($id)->update($request->only('name', 'description', 'parent_id', 'sort_order'));
    return \Redirect::route('admin.job_categories.index')
    ->with('message', 'Job Category updated');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $category = $this->categories->findOrFail($id);
    if ($category) {
      $category->delete();
      return \Redirect::to('admin/job_categories')
      ->with('message', 'Job Category Deleted');
    }
    return \Redirect::to('admin/job_categories')
    ->with('message', 'Something went wrong, please try again');
  }
}
