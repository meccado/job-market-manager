<?php

Route::group(['namespace' 	=> 'App\Http\Controllers',
							'middleware' 	=> ['web', 'throttle'],
 							], function(){
			//'prefix'=>'api/v1',
			Route::group(['prefix' =>  'admin',
                          'middleware' 	=> ['auth', 'admin'],
	 					 							'namespace' 	=> 'Admin'],
                         function(){
                      		Route::resource('job_tags', 'JobTagController', ['only' => ['index', 'show','create', 'store', 'edit', 'update', 'destroy']]);
                      		Route::resource('jobs', 'JobController', ['only' => ['index', 'show','create', 'store', 'edit', 'update', 'destroy']]);
                      		Route::resource('job_categories', 'JobCategoryController', ['only' => ['index', 'show','create', 'store', 'edit', 'update', 'destroy']]);
													Route::post('jobs/{jobs}/upload', ['as' => 'admin.jobs.upload', 'uses' => 'JobController@upload']);
													Route::get('jobs/{jobs}/image-upload', ['as' => 'admin.jobs.image-upload', 'uses' => 'JobController@getUpload']);
			});
});

View::composer('*', function ($view) {
  $job_categories			= \App\JobCategory::where('parent_id', '=', 0)->get();//
		if(!$job_categories){
			$job_categories 	= [];
		}
		$job_tags					= \App\JobTag::with('jobs')->get();
		if(!$job_tags){
			$job_tags 			= [];
		}
    $view->with(compact('job_categories', 'job_tags'));
});
