<?php

use Illuminate\Database\Seeder;

class DestacadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Destacado::class,30)->create();
    }
}
