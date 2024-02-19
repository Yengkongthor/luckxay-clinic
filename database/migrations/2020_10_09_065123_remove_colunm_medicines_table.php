<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColunmMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicines', function (Blueprint $table) {
            $table->dropColumn(['manufacture_date', 'best_before_date', 'cost', 'brand_name', 'type']);
            $table->integer('brand_id');
            $table->integer('category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicines', function (Blueprint $table) {
            $table->date('manufacture_date');
            $table->date('best_before_date');
            $table->double('cost');
            $table->string('type');
            $table->string('brand_name');
        });
    }
}
