<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Marca;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marca = new Marca();
        $marca->nome = "Wolksvagem";
        $marca->imagem = "teste.jpeg";
        $marca->save();

        $marca_2 = new Marca();
        $marca_2->nome = "Peugeot";
        $marca_2->imagem = "teste.jpeg";
        $marca_2->save();

        $marca_3 = new Marca();
        $marca_3->nome = "Ford";
        $marca_3->imagem = "teste.jpeg";
        $marca_3->save();

        $marca_4 = new Marca();
        $marca_4->nome = "BMW";
        $marca_4->imagem = "teste.jpeg";
        $marca_4->save();
    }
}
