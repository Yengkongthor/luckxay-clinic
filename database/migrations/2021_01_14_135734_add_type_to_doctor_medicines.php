<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToDoctorMedicines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctor_medicines', function (Blueprint $table) {
            $table->string('type')->after('tablets')->nullable();
            $table->string('dose')->after('type')->nullable();
            $table->string('use')->after('dose')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctor_medicines', function (Blueprint $table) {
            $table->dropColumn(['type', 'dose', 'use']);
        });
    }
}
