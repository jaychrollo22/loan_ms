<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LoanBilling extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_billings', function (Blueprint $table) {
            $table->id();
            $table->integer('borrower_id');
            $table->integer('loan_id');
            $table->integer('week_number');
            $table->date('schedule_date');
            $table->double('principal', 15,2)->nullable();
            $table->double('interest', 15,2)->nullable();
            $table->double('total_amount', 15,2)->nullable();
            $table->timestamps();
            $table->softDeletes();
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
