<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueuedCommandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queued_commands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('server_id');
            $table->string('command');
            $table->boolean('need_player_online')->default(false);
            $table->integer('order_id')->nullable();
            $table->integer('player_id')->nullable();
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
        Schema::dropIfExists('queued_commands');
    }
}
