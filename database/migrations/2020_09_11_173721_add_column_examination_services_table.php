<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnExaminationServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('examination_services', function (Blueprint $table) {
            $table->integer('lab_id')->after('service_id');
            $table->integer('lab_detail_id')->after('lab_id');
            $table->double('value')->nullable()->after('lab_detail_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('examination_services', function (Blueprint $table) {
            $table->dropColumn(['lab_id', 'lab_detail_id', 'value']);
        });
    }
}
