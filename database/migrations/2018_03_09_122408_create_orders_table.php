<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->longText('commands')->nullable();
            $table->longText('products')->nullable();
            $table->string('currency')->default("USD");
            $table->string('gateway')->nullable();
            $table->string('txid')->nullable();
            $table->longText('discount')->nullable();
            $table->double('total', 8, 2)->default(0.00);
            $table->enum('status', ['awaiting_payment', 'payment_received','awaiting_processing','processed','compleated','chargeback'])->default("awaiting_payment");
            $table->longText('postdata')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
