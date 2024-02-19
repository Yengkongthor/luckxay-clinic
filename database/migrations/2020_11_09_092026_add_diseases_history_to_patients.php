<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiseasesHistoryToPatients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->text('diseases_history')->nullable();
            $table->text('medicine_history')->nullable();
            $table->boolean('drug_allergy_or_food')->default(false);
            $table->text('drug_or_food')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn(['diseases_history', 'medicine_history', 'drug_allergy_or_food', 'drug_or_food']);
        });
    }
}
