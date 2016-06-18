<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('purpose');
            $table->text('experience');
            $table->text('content');
            $table->string('slug')->unique();
            $table->decimal('start_range', 10, 2);
            $table->decimal('end_range', 12, 2);
            $table->timestamp('published_at');
            $table->timestamp('expiration_at');
            $table->boolean('published')->default(0);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jobs');
    }
}
