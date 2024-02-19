<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullToBestBeforeDateInMedicinePricing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicine_pricing', function (Blueprint $table) {
            $table->date('best_before_date')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicine_pricing', function (Blueprint $table) {
            $table->date('best_before_date')->nullable(false)->change();

        });
    }
}
