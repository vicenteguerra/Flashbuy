<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCredicCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_card', function (Blueprint $table) {
            $table->increments('card_id')->unsigned();
            
            $table->integer('credit_card_type_id')->unsigned()->index();
            $table->foreign('credit_card_type_id')->references('credit_card_type_id')->on('credit_card_type');
            $table->string('name', 150);
            $table->string('number')->unique();
            $table->string('address_id', 250);
            $table->string('expiration_month', 50);
            $table->string('expiration_year', 50);
            
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
