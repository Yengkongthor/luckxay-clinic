<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaSpo2PrToBasicPhysicalExaminations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('basic_physical_examinations', function (Blueprint $table) {
            $table->string('ta')->after('temperature')->nullable();
            $table->string('spo2')->after('ta')->nullable();
            $table->string('pr')->after('spo2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('basic_physical_examinations', function (Blueprint $table) {
            $table->dropColumn(['ta', 'spo2', 'pr']);
        });
    }
}
