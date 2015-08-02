<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('customer_id')->unsigned();
            $table->string('firstname', 150);
            $table->string('lastname', 150);
            $table->string('email')->unique();
            $table->string('password', 250);
            $table->string('phone', 50);
            $table->string('nationality', 100);
            $table->date('birthday');
            $table->enum('gender', ['F', 'M']);
            $table->integer('customer_type_id')->unsigned()->index();
            $table->foreign('customer_type_id')->references('customer_type_id')->on('customers_type');
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
