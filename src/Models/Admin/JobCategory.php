<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class JobCategory extends Model
{
  protected $guarded = ['id'];
  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'name', 'description', 'parent_id', 'sort_order',
  ];
  public function jobs()
  {
    return $this->belongsToMany(\App\Job::class);
  }
  public function parent()
  {
    return $this->belongsTo('App\JobCategory', 'parent_id');
  }
  public function children()
  {
    return $this->hasMany('App\JobCategory', 'parent_id');
  }
}
