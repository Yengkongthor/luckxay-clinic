<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullToProviceInPatients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->string('province')->nullable()->change();
            $table->string('district')->nullable()->change();
            $table->string('village')->nullable()->change();
            $table->integer('age')->default(0)->change();
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
            $table->string('province')->nullable(false)->change();
            $table->string('district')->nullable(false)->change();
            $table->string('village')->nullable(false)->change();

        });
    }
}
