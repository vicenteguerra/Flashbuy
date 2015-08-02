<?php

# database/seeds/CustomerTypeTableSeeder.php
use App\CustomerType;
use Illuminate\Database\Seeder;

class CustomerTypeTableSeeder extends Seeder  
{
    public function run()
    {        
        CustomerType::create([
            'type' => 'personal',
        ]);

        CustomerType::create([
            'type' => 'business',
        ]);
    }
}

