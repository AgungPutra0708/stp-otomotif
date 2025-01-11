<?php

namespace Database\Seeders;

use App\Models\CarCatalogueServiceModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $car = [
            'Avanza',
            'Xenia',
            'Pajero',
            'Fortuner',
        ];

        foreach ($car as $item) {
            CarCatalogueServiceModel::create([
                'name' => $item,
            ]);
        }
    }
}
