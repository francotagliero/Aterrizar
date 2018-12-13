<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTransactionsTableAddDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('extra');
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->nullableMorphs('detail');
            $table->text('extra')->nullable();

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
            $table->dropColumn('extra');
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('detail_id');
            $table->dropColumn('detail_type');
            $table->text('extra');
        });
    }
}
