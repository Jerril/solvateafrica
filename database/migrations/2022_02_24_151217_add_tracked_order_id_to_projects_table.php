<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTrackedOrderIdToProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        if(!Schema::hasColumn('projects', 'tracked_order_id')){
            Schema::table('projects', function (Blueprint $table) {
                //
                $table->integer('tracked_order_id')->unsigned();
                $table->foreign('tracked_order_id')->references('id')->on('trackorders')->onDelete('cascade');
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
        Schema::table('projects', function (Blueprint $table) {
            //
            $table->dropColumn('tracked_order_id');
        });
    }
}
