<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoBorrowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('co_borrowers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('borrower_id');
            $table->char('business_name',120);
            $table->char('first_name',60);
            $table->char('middle_name',60);
            $table->char('last_name',60);
            $table->char('suffix',10)->nullable();
            $table->integer('country_id');
            $table->integer('region_id');
            $table->integer('county');
            $table->integer('township');
            $table->string('address');
            $table->integer('property_type_id');
            $table->integer('age');
            $table->integer('civil_status_id');
            $table->char('contact_number',40);
            $table->char('email_address',80)->nullable();
            $table->integer('valid_id_type_id');
            $table->char('id_number',80);
            $table->integer('relationship_id');
            $table->integer('nature_of_business_id');
            $table->string('business_address');
            $table->integer('business_property_type_id');
            $table->double('monthly_sale', 15,2);
            $table->double('monthly_profit', 15,2);
            $table->char('file_name',80)->nullable();
            $table->char('file_path',80)->nullable();
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
        Schema::dropIfExists('co_borrowers');
    }
}
