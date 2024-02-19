<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameQueueIdToAssignPatientEmployeeStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_statuses', function (Blueprint $table) {
            $table->dropColumn(['queue_id']);
            $table->boolean('assign')->default(0)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_statuses', function (Blueprint $table) {
            $table->integer('queue_id');
            $table->dropColumn(['assign']);
        });
    }
}
