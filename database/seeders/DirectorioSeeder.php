<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class DirectorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contactos')->insert([
            [
                'nombre'    => 'Daniel Jesus Naula',
                'direccion' => 'Chillogallo Buenaventura',
                'telefono'  => 987979423,
                'foto'      => null,
            ],
            [
                'nombre'    => 'Israel David Naula',
                'direccion' => 'Sangolqui',
                'telefono'  => 984567896,
                'foto'      => null,
            ],
        ]);
    }
}
