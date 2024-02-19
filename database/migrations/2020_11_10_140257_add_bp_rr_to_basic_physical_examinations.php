<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBpRrToBasicPhysicalExaminations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('basic_physical_examinations', function (Blueprint $table) {
            $table->string('bp');
            $table->string('rr');
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
            $table->dropColumn(['bp', 'rr']);
        });
    }
}
