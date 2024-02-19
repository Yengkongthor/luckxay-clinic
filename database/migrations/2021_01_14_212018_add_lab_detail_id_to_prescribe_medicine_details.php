<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLabDetailIdToPrescribeMedicineDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prescribe_medicine_details', function (Blueprint $table) {
            $table->integer('lab_detail_id')->nullable()->after('medicine_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prescribe_medicine_details', function (Blueprint $table) {
            $table->dropColumn(['lab_detail_id']);
        });
    }
}
