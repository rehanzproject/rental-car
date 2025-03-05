<?php

namespace Database\Seeders;

use App\Models\TypeMobil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeMobilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeMobil::create([
            'type_mobil' => 'Sedan',
            'bensin' => 'Pertalite',
            'jumlah' => '2',
        ]);
        TypeMobil::create([
            'type_mobil' => 'SUV',
            'bensin' => 'Pertamax',
            'jumlah' => '4',
        ]);
        TypeMobil::create([
            'type_mobil' => 'MPV',
            'bensin' => 'Pertamax Turbo',
            'jumlah' => '0',
        ]);
        TypeMobil::create([
            'type_mobil' => 'Crossover',
            'bensin' => 'Pertamax Turbo',
            'jumlah' => '7',
        ]);
        TypeMobil::create([
            'type_mobil' => 'Hatchback',
            'bensin' => 'Pertalite',
            'jumlah' => '1',
        ]);
        TypeMobil::create([
            'type_mobil' => 'Pickup',
            'bensin' => 'Pertalite',
            'jumlah' => '8',
        ]);
    }
}
