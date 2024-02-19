<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBookAnAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('book_an_appointments', function (Blueprint $table) {
            $table->date('booking_date')->after('user_id');
            $table->integer('booking_time')->after('booking_date');
            $table->unique(['booking_date', 'booking_time'], 'booking_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book_an_appointments', function (Blueprint $table) {
            $table->dropUnique('booking_unique');
            $table->dropColumn(['booking_date', 'booking_time']);
        });
    }
}
