<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranks', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->mediumText('description');
            $table->boolean('Moderator Panel 1');
            $table->boolean('Moderator Panel 2');
            $table->boolean('Admin Panel 1');
            $table->boolean('Admin Panel 2');
            $table->boolean('Admin Panel 3');
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
        Schema::dropIfExists('ranks');
    }
}
