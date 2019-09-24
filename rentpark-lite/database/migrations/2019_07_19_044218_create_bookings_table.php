<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_id');
            $table->integer('user_id');
            $table->integer('provider_id');
            $table->integer('host_id');
            $table->text('description');
            $table->integer('total_spaces')->default(1);
            $table->dateTime('checkin');
            $table->dateTime('checkout');
            $table->string('duration')->default(0);
            $table->string('currency')->default("$");
            $table->string('payment_mode')->default('cod');
            $table->float('per_hour')->default(0.00);
            $table->float('total')->default(0.00);
            $table->tinyInteger('status')->default(0);
            $table->dateTime('cancelled_date')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}
