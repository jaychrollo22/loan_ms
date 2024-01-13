<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusColumnToCoBorrowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('co_borrowers', function (Blueprint $table) {
            $table->char('city',100);
            $table->char('status',50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('co_borrowers', function (Blueprint $table) {
            $table->dropColumn('city');
            $table->dropColumn('status');
        });
    }
}
