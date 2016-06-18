<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class JobTag extends Model
{
  protected $fillable = ['name',];
  public function jobs()
  {
    return $this->belongsToMany(\App\Job::class);
  }
}
