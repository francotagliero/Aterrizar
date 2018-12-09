<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTransactionsTableAddMorph extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('service_name');
            $table->dropColumn('service_id');
        });       
        Schema::table('transactions', function (Blueprint $table) {
            $table->morphs('service');
        });       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('service_type');
            $table->dropColumn('service_id');
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('service_name');
            $table->integer('service_id');
        });
    }
}
