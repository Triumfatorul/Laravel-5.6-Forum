<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableChat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Create a table for chat
        Schema::create('chat', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('content');
            $table->integer('sender_id');
            $table->integer('reciver_id');
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
       Schema::dropIfExists('chat');
    }
}
