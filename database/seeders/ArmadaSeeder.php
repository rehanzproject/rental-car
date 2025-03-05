<?php

namespace Database\Seeders;

use App\Models\Armada;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArmadaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Armada::create([
            'typemobil_id' => 1,
            'nama_mobil' => 'Civic',
            'plat_nomor' => 'AD 7645 HF',
            'status' => 0,
            'harga' => 300000
        ]);
        Armada::create([
            'typemobil_id' => 1,
            'nama_mobil' => 'Avansa',
            'plat_nomor' => 'AD 4344 HKK',
            'status' => 1,
            'harga' => 300000
        ]);
        Armada::create([
            'typemobil_id' => 2,
            'nama_mobil' => 'Supra',
            'plat_nomor' => 'B 7766 F',
            'status' => 0,
            'harga' => 500000
        ]);
        Armada::create([
            'typemobil_id' => 2,
            'nama_mobil' => 'Lamborgini',
            'plat_nomor' => 'AD 4343 S',
            'status' => 0,
            'harga' => 500000
        ]);
        Armada::create([
            'typemobil_id' => 3,
            'nama_mobil' => 'GTR',
            'plat_nomor' => 'AD 4544 DS',
            'status' => 0,
            'harga' => 800000
        ]);
        Armada::create([
            'typemobil_id' => 3,
            'nama_mobil' => 'GranMax',
            'plat_nomor' => 'CC 3444 DSD',
            'status' => 0,
            'harga' => 800000
        ]);
        Armada::create([
            'typemobil_id' => 3,
            'nama_mobil' => 'Brio',
            'plat_nomor' => 'B 2322 D',
            'status' => 1,
            'harga' => 800000
        ]);
        Armada::create([
            'typemobil_id' => 4,
            'nama_mobil' => 'XPander',
            'plat_nomor' => 'AD 2234 WS',
            'status' => 0,
            'harga' => 800000
        ]);
    }
}
