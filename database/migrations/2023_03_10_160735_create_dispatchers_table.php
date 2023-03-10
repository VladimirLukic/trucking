<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispatchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatchers', function (Blueprint $table) {
            $table->id();
            $table->string('driver_name');
            $table->string('truck_number');
            $table->string('trailer_number');
            $table->string('route');
            $table->dateTime('pickup', $precision = 0);
            $table->dateTime('drop', $precision = 0);
            $table->string('load');
            $table->integer('mileage');
            $table->integer('price');
            $table->string('broker_name');
            $table->string('customer_name');
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
        Schema::dropIfExists('dispatchers');
    }
}
