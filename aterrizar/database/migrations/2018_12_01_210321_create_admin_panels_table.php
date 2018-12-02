<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminPanelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_panel', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('max_flight_duration');
            $table->float('percentage_stopover');
            $table->integer('max_gap');
            $table->float('return_tax');
            $table->float('points_per_peso');
            $table->float('pesos_per_point');
            $table->float('firstclass_factor');
            $table->float('bussinessclass_factor');
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
        Schema::dropIfExists('admin_panel');
    }
}
