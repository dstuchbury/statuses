<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up() {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('status');
            $table->string('order_ref', 50);
            $table->date('date_received');
            $table->date('date_sla');

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('orders');
    }
}
