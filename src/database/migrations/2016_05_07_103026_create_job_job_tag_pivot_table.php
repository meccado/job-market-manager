<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobJobTagPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('job_job_tag', function (Blueprint $table) {
          $table->integer('job_tag_id')->unsigned()->index();
          $table->foreign('job_tag_id')->references('id')->on('job_tags')->onDelete('cascade');
          $table->integer('job_id')->unsigned()->index();
          $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
          $table->primary(['job_id', 'job_tag_id']);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('job_job_tag');
    }
}
