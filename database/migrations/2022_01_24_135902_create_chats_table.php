<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('chats')){
            Schema::create('chats', function (Blueprint $table) {
                $table->id();
                $table->foreignId('sender_id');
                $table->foreignId('recipient_id');
                $table->text('message');
                $table->string('title')->nullable();
                $table->string('attachment')->nullable();
                $table->timestamps();
                $table->softDeletes();

                $table->foreign("sender_id")->references("id")->on("users")->onDelete("cascade");
                $table->foreign("recipient_id")->references("id")->on("users")->onDelete("cascade");
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
        Schema::dropIfExists('chats');
    }
}
