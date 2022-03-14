<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        if(!Schema::hasTable('jobs')){
            Schema::create('jobs', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('job_description');
                $table->string('milestone');
                $table->string('price_budget');
                $table->string('category');
                $table->string('job_type');
                $table->string('skill')->nullable();
                $table->unsignedBigInteger("user_id");
                $table->unsignedBigInteger("creative_id")->nullable()->comment('talent who won the bid');
                $table->date("start_date")->nullable();
                $table->date("end_date")->nullable();
                $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
