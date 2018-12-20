<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVirtualTransactionsTable extends Migration
{
    /** 
     * Run the migrations.
     *
     * @return void 
     */
    public function up()
    {
        Schema::create('virtual_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id");
            $table->json("before");
            $table->json("after");
            $table->integer("currency_id");
            $table->string("cause");
            $table->string("reason");
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
        Schema::dropIfExists('virtual_transactions');
    }
}
