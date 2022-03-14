<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        if(!Schema::hasTable('job_users')){
            Schema::create('job_users', function (Blueprint $table) {
                $table->id();
                $table->foreignId("job_id");
                $table->foreignId("user_id");
                $table->string("accept_price")->nullable();
                $table->string("price_to_accept")->nullable();
                $table->timestamps();

                $table->foreign("job_id")->references("id")->on("jobs")->onDelete("cascade");
                $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
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
        Schema::dropIfExists('job_users');
    }
}
