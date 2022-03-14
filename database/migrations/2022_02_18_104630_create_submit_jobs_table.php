<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmitJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submit_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrianed()->onDelete('cascade');
            $table->foreignId('hunter_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('creative_id')->constrained('users')->onDelete('cascade');
            $table->text('comment');
            $table->string('path')->nullable();
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
        Schema::dropIfExists('submit_jobs');
    }
}
