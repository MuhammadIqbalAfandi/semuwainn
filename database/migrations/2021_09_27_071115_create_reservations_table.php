<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->timestamp('reservation_time');
            $table->string('reservation_number');
            $table->date('checkin');
            $table->date('checkout');
            $table->unsignedInteger('discount')->default(0);
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('guest_id')->constrained();
            $table->foreignId('reservation_status_id')->default(2)->constrained();
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
        Schema::dropIfExists('reservations');
    }
}
