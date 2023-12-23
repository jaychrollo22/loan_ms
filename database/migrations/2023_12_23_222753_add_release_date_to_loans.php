<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReleaseDateToLoans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->date('release_date')->after('total_interest')->nullable();
            $table->bigInteger('account_officer')->after('total_interest')->nullable();
            $table->bigInteger('checked_by')->after('total_interest')->nullable();
            $table->bigInteger('created_by')->after('total_interest')->nullable();
            $table->bigInteger('approved_by')->after('total_interest')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loans', function (Blueprint $table) {
            //
        });
    }
}
