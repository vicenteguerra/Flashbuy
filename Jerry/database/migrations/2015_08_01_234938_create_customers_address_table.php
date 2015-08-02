<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_address', function (Blueprint $table) {
            $table->increments('address_id');
            $table->integer('customer_id')->unsigned()->index();
            $table->foreign('customer_id')->references('customer_id')->on('customers');
            $table->enum('country', ['US', 'MX']);
            $table->string('subdivision');
            $table->string('street_name_number');
            $table->string('street_number_inside');
            $table->integer('colony');
            $table->string('delegation_or_municipality');
            $table->string('city');
            $table->string('postcode');
            $table->mediumText('comment');
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
