<?php

use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Categoria::class, 150)->create()->each(
            function ($categoria) {
                if ($categoria->id > 17) {
                    $cat = App\Categoria::find($categoria->id);
                    $cat->categoria_id =  App\Categoria::all()->random()->id;
                    $cat->save();
                }
            }
        );
    }
}
