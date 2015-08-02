<?php

# database/seeds/CreditCardTypeTableSeeder.php
use App\CreditCardType;
use Illuminate\Database\Seeder;

class CreditCardTypeTableSeeder extends Seeder  
{
    public function run()
    {

    	CreditCardType::create([
            'type' => 'mastercard',
        ]);
        CreditCardType::create([
            'type' => 'visa',
        ]);
    }
}

