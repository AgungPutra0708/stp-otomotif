<?php

namespace Database\Seeders;

use App\Models\CategoryModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Kit Konversi',
            'Produk Custom',
            'Komponen Ev',
            'Produk Lain',
        ];

        foreach ($categories as $category) {
            CategoryModel::create([
                'name' => $category,
            ]);
        }
    }
}
