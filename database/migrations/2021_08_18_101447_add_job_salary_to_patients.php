<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJobSalaryToPatients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->string('job')->nullable();
            $table->string('salary')->nullable();
            $table->string('sos')->nullable();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('users_email_unique');
            $table->string('email')->nullable()->change();
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
            $table->dropColumn('job');
            $table->dropColumn('salary');
            $table->dropColumn('sos');
        });
    }
}
