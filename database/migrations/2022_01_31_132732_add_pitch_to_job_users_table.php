<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPitchToJobUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        if (!Schema::hasColumn('job_users', 'pitch'))
        {
            Schema::table('job_users', function (Blueprint $table) {
                //
                $table->text('pitch')->after('price_to_accept');
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
        Schema::table('job_users', function (Blueprint $table) {
            //
            $table->dropColumn('pitch');
        });
    }
}
