<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('city_from')->unsigned();
            $table->integer('city_to')->unsigned();
            $table->date('date');
            $table->time('time');
            $table->time('duration');
            $table->decimal('price', 8, 2);
            $table->integer('economy_seats');
            $table->integer('business_seats');
            $table->integer('first_class_seats');
            $table->timestamps();
            // Constraints at DB level
            // $table->foreign('city_from')->references('id')->on('city');
            // $table->foreign('city_to')->references('id')->on('city');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flights');
    }
}
