<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueLabIdToExaminationLabDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('examination_lab_details', function (Blueprint $table) {
            $table->integer('lab_id')->after('lab_detail_id');
            $table->double('value')->after('lab_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('examination_lab_details', function (Blueprint $table) {
            $table->dropColumn(['lab_id', 'value']);
        });
    }
}
