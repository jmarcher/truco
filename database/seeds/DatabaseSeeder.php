<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('UserTableSeeder');
        $this->command->info('User table seeded!');

        $this->call('CartasSeeder');
        $this->command->info('Cartas agregadas!');
    }

}


class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('games')->delete();
        DB::table('users')->delete();

        User::create(array('email' => 'joacorock@gmail.com', 'password' => Hash::make("pass"), "name" => "Joaquin"));
        User::create(array('email' => 'diego@gmail.com', 'password' => Hash::make("pass"), "name" => "Diego"));
    }

}

class CartasSeeder extends Seeder
{


    public function run()
    {
        DB::table("cartas")->delete();
        Carta::create(array("numero" => 1, "palo" => "oro"));
        Carta::create(array("numero" => 2, "palo" => "oro"));
        Carta::create(array("numero" => 3, "palo" => "oro"));
        Carta::create(array("numero" => 4, "palo" => "oro"));
        Carta::create(array("numero" => 5, "palo" => "oro"));
        Carta::create(array("numero" => 6, "palo" => "oro"));
        Carta::create(array("numero" => 7, "palo" => "oro"));
        Carta::create(array("numero" => 10, "palo" => "oro"));
        Carta::create(array("numero" => 11, "palo" => "oro"));
        Carta::create(array("numero" => 12, "palo" => "oro"));

        Carta::create(array("numero" => 1, "palo" => "basto"));
        Carta::create(array("numero" => 2, "palo" => "basto"));
        Carta::create(array("numero" => 3, "palo" => "basto"));
        Carta::create(array("numero" => 4, "palo" => "basto"));
        Carta::create(array("numero" => 5, "palo" => "basto"));
        Carta::create(array("numero" => 6, "palo" => "basto"));
        Carta::create(array("numero" => 7, "palo" => "basto"));
        Carta::create(array("numero" => 10, "palo" => "basto"));
        Carta::create(array("numero" => 11, "palo" => "basto"));
        Carta::create(array("numero" => 12, "palo" => "basto"));

        Carta::create(array("numero" => 1, "palo" => "espada"));
        Carta::create(array("numero" => 2, "palo" => "espada"));
        Carta::create(array("numero" => 3, "palo" => "espada"));
        Carta::create(array("numero" => 4, "palo" => "espada"));
        Carta::create(array("numero" => 5, "palo" => "espada"));
        Carta::create(array("numero" => 6, "palo" => "espada"));
        Carta::create(array("numero" => 7, "palo" => "espada"));
        Carta::create(array("numero" => 10, "palo" => "espada"));
        Carta::create(array("numero" => 11, "palo" => "espada"));
        Carta::create(array("numero" => 12, "palo" => "espada"));

        Carta::create(array("numero" => 1, "palo" => "copa"));
        Carta::create(array("numero" => 2, "palo" => "copa"));
        Carta::create(array("numero" => 3, "palo" => "copa"));
        Carta::create(array("numero" => 4, "palo" => "copa"));
        Carta::create(array("numero" => 5, "palo" => "copa"));
        Carta::create(array("numero" => 6, "palo" => "copa"));
        Carta::create(array("numero" => 7, "palo" => "copa"));
        Carta::create(array("numero" => 10, "palo" => "copa"));
        Carta::create(array("numero" => 11, "palo" => "copa"));
        Carta::create(array("numero" => 12, "palo" => "copa"));
    }

}