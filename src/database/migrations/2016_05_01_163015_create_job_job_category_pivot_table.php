<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobJobCategoryPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('job_job_category', function (Blueprint $table) {
          $table->integer('job_category_id')->unsigned()->index();
          $table->foreign('job_category_id')->references('id')->on('job_categories')->onDelete('cascade');
          $table->integer('job_id')->unsigned()->index();
          $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
          $table->primary(['job_category_id', 'job_id']);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('job_job_category');
    }
}
