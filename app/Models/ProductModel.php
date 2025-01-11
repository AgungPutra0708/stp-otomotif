<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ProductModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "products";

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id');  // Misalnya kategori di model CategoryModel
    }

    // Jika relasi produk dengan gambar adalah One-to-Many
    public function images()
    {
        return $this->hasMany(ProductImageModel::class, 'product_id');  // Misalnya gambar di model ImageModel
    }

    // Fungsi untuk membuat slug dari nama produk
    public static function generateSlug($name)
    {
        // Buat slug dari nama produk dan pastikan slug unik
        $slug = Str::slug($name);

        // Cek jika slug sudah ada, tambahkan angka untuk membuatnya unik
        $existingSlugCount = ProductModel::where('slug', $slug)->count();
        if ($existingSlugCount > 0) {
            $slug .= '-' . ($existingSlugCount + 1);
        }

        return $slug;
    }
}
