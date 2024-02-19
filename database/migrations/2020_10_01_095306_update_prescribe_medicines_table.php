<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePrescribeMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prescribe_medicines', function (Blueprint $table) {
            $table->renameColumn('queue_id','patient_history_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prescribe_medicines', function (Blueprint $table) {
            $table->renameColumn('patient_history_id','queue_id');
        });
    }
}
