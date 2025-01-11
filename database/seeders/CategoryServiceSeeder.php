<?php

namespace Database\Seeders;

use App\Models\CategoryServiceModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Konversi Roda 2',
            'Konversi',
            'Uji tipe',
            'Sirkuit',
            'Coming Soon',
        ];

        foreach ($categories as $category) {
            CategoryServiceModel::create([
                'name' => $category,
            ]);
        }
    }
}
