<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColunmLabMedicineToPrescribeMedicines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prescribe_medicines', function (Blueprint $table) {
            $table->double('total_lab_detail')->after('money')->nullable();
            $table->double('total_medicine')->after('total_lab_detail')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prescribe_medicines', function (Blueprint $table) {
            $table->dropColumn(['total_lab_detail', 'total_medicine']);
        });
    }
}
