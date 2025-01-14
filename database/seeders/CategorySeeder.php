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
        $categorys = [
            'Kit Konversi',
            'Produk Custom',
            'Komponen Ev',
            'Produk Lain',
        ];

        foreach ($categorys as $category) {
            CategoryModel::create([
                'name' => $category,
            ]);
        }
    }
}
