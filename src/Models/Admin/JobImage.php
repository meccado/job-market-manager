<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobImage extends Model
{
  protected $fillable = ['job_id', 'file_name', 'file_size', 'file_mime', 'file_path', 'created_by'];


  public function job()
  {
    return $this->belongsTo(\App\Job::class);
  }
}
