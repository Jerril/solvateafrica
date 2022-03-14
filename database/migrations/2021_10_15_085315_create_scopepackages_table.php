<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScopepackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scopepackages', function (Blueprint $table) {
            $table->id();
            $table->string('package');
            $table->mediumText('description');
            $table->string('delivery');
            $table->string('revisions');
            $table->decimal('price',10,2);
            $table->unsignedBigInteger('gigId')->nullable();
            $table->foreign('gigId')->references('id')->on('gigs')->onDelete('cascade');
            $table->unsignedBigInteger('userId')->nullable();
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('scopepackages');
    }
}
