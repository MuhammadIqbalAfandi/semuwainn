<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_orders', function (Blueprint $table) {
            $table->id();
            $table->timestamp('order_time');
            $table->unsignedInteger('price');
            $table->unsignedInteger('guest_count');
            $table->unsignedInteger('quantity');
            $table->foreignId('reservation_id')->constrained();
            $table->foreignId('room_id')->constrained();
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
        Schema::dropIfExists('room_orders');
    }
}
