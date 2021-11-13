<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderlinesTable extends Migration
{
    public function up() {
        Schema::create('orderlines', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('order_id');
            $table->integer('status');
            $table->integer('quantity');
            $table->decimal('price_unit');
            $table->decimal('price_total', 10);

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('orderlines');
    }
}
