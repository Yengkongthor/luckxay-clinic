<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullToLaoFirstNameAndLaoLastName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->string('lao_first_name')->nullable()->change();
            $table->string('lao_last_name')->nullable()->change();
            $table->string('nick_name')->nullable()->change();
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
            $table->string('lao_first_name')->nullable(false)->change();
            $table->string('lao_last_name')->nullable(false)->change();
            $table->string('nick_name')->nullable(false)->change();
        });
    }
}
