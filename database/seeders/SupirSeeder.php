<?php

namespace Database\Seeders;

use App\Models\Supir;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supir::create([
            'nama' => 'Galang Ardiansyah',
            'usia' => fake()->numberBetween(18, 50),
            'jenis_kelamin' => 'Laki-Laki',
            'alamat' => 'Larangan, Sukoharjo, Jawa Tengah, Indonesia, Bumi, Galaxy Bima Sakti',
            'status' => 'Tersedia'
        ]);
        Supir::create([
            'nama' => "Fadky Rizki Maulana",
            'usia' => fake()->numberBetween(18, 50),
            'jenis_kelamin' => 'Laki-Laki',
            'alamat' => 'Kuala Lumpur, Malaysia, Bumi, Galaxy Bima Sakti',
            'status' => 'Disewa'
        ]);
        Supir::create([
            'nama' => "Sidiq Kurniawan",
            'usia' => fake()->numberBetween(18, 50),
            'jenis_kelamin' => 'Laki-Laki',
            'alamat' => 'Ohio, Amerika Serikat, Bumi, Galaxy Bima Sakti',
            'status' => 'Tersedia'
        ]);
        Supir::create([
            'nama' => "Shelva Aurora Maharani",
            'usia' => fake()->numberBetween(18, 50),
            'jenis_kelamin' => 'Perempuan',
            'alamat' => 'Ohio, Amerika Serikat, Bumi, Galaxy Bima Sakti',
            'status' => 'Tersedia'
        ]);
        Supir::create([
            'nama' => "Vavian Ega Ramadhan",
            'usia' => fake()->numberBetween(18, 50),
            'jenis_kelamin' => 'Laki-Laki',
            'alamat' => 'Hiroshima, Jepang, Bumi, Galaxy Bima Sakti',
            'status' => 'Tersedia'
        ]);
        Supir::create([
            'nama' => "Nabil Ramadhan",
            'usia' => fake()->numberBetween(18, 50),
            'jenis_kelamin' => 'Laki-Laki',
            'alamat' => 'Jakarta, Indonesia, Bumi, Galaxy Bima Sakti',
            'status' => 'Disewa'
        ]);
        Supir::create([
            'nama' => "Bunga Aprillia",
            'usia' => fake()->numberBetween(18, 50),
            'jenis_kelamin' => 'Perempuan',
            'alamat' => 'Kalimantan Tengah, Indonesia, Bumi, Galaxy Bima Sakti',
            'status' => 'Tersedia'
        ]);
        Supir::create([
            'nama' => "Anggun Pertiwi",
            'usia' => fake()->numberBetween(18, 50),
            'jenis_kelamin' => 'Perempuan',
            'alamat' => 'Kalimantan Tengah, Indonesia, Bumi, Galaxy Bima Sakti',
            'status' => 'Tersedia'
        ]);
    }
}
