<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([
            CategoriaSeeder::class,
            UserSeeder::class,
            //CreditoSeeder::class,
            AnuncioSeeder::class,
            FotoSeeder::class,
            //DestacadoSeeder::class,
            //BannerSeeder::class,
            FavoritoSeeder::class,

         ]);
    }
}
