<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColunmToPatientHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_histories', function (Blueprint $table) {
            $table->integer('patient_historyable_id')->nullable()->after('id');
            $table->string('patient_historyable_type')->nullable()->after('patient_historyable_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_histories', function (Blueprint $table) {
            $table->dropColumn(['patient_historyable_id', 'patient_historyable_type']);
        });
    }
}
