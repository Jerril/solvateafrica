<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtragigservicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extragigservices', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('revision');
            $table->string('price');
            $table->unsignedBigInteger('gigId')->nullable();
            $table->foreign('gigId')->references('id')->on('gigs')->onDelete('cascade');
            $table->unsignedBigInteger('userId')->nullable();
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extragigservices');
    }
}
