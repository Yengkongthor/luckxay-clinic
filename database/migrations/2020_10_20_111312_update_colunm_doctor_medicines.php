<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColunmDoctorMedicines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctor_medicines', function (Blueprint $table) {
            $table->string('time')->nullable()->after('amount');
            $table->string('tablet')->nullable()->after('time');
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
            $table->dropColumn(['time', 'tablet']);
        });
    }
}
