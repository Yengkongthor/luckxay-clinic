<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePrescribeMedicineDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prescribe_medicine_details', function (Blueprint $table) {
            $table->dropColumn(['medicine_id', 'cost']);
            $table->string('name')->after('prescribe_medicine_id');
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
            $table->double('cost');
            $table->integer('medicine_id');
        });
    }
}
