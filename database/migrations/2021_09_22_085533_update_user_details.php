<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_details', function (Blueprint $table) {
            $table->unsignedBigInteger('countryId')->nullable();
            $table->foreign('countryId')->references('id')->on('countries')->onDelete('cascade');
            $table->unsignedBigInteger('stateId')->nullable();
            $table->foreign('stateId')->references('id')->on('states')->onDelete('cascade');
            $table->unsignedBigInteger('cityId')->nullable();
            $table->foreign('cityId')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_details', function (Blueprint $table) {
            //
        });
    }
}
