<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon as Carbon;

class Job extends Model
{
  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'name', 'content', 'slug', 'tags', 'categories','published_at', 'published',
    'start_range', 'end_range', 'expiration_at', 'purpose', 'experience'
  ];

  protected $dates = ['published_at', 'expiration_at'];

  public function scopePublished($query){
    $query->where('published_at' , '<=', Carbon::now());
  }

  public function scopeExpired($query){
    $query->where('expiration_at' , '<=', Carbon::now());
  }

  public function setPublishedAtAttribute($date)
  {
    $this->attributes['published_at'] = Carbon::parse($date);
  }

  public function setExpirationAtAttribute($date)
  {
    $this->attributes['expiration_at'] = Carbon::parse($date);
  }

  public function categories()
  {
    return $this->belongsToMany(\App\JobCategory::class);
  }

  public function tags()
  {
    return $this->belongsToMany(\App\JobTag::class);
  }

  public function assignTag(JobTag $tag)
  {
    return $this->tags()->save($tag);
  }

  public function assignCategory(JobCategory $category)
  {
    return $this->categories()->save($category);
  }

  public function images()
  {
    return $this->hasMany(\App\JobImage::class);
  }
}
