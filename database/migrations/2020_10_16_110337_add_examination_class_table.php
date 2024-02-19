<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExaminationClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_statuses', function (Blueprint $table) {
            $table->string('examination_class')->nullable()->after('assign');
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
            $table->dropColumn(['examination_class']);
        });
    }
}
