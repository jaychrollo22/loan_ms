<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Loan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('borrower_id');
            $table->bigInteger('type')->nullable();
            $table->integer('term')->nullable();
            $table->double('amount', 15,2)->nullable();
            $table->double('interest', 15,2)->nullable();
            $table->double('total_amount', 15,2)->nullable();
            $table->double('total_interest', 15,2)->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
