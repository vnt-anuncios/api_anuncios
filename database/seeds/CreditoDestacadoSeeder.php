<?php

use Illuminate\Database\Seeder;

class CreditoDestacadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\CreditoDestacado::class,15)->create();
    }
}
