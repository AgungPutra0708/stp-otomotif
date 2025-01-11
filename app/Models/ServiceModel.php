<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ServiceModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "services";

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(CategoryServiceModel::class, 'category_services_id');
    }

    // Fungsi untuk membuat slug dari nama produk
    public static function generateSlug($name)
    {
        // Buat slug dari nama produk dan pastikan slug unik
        $slug = Str::slug($name);

        // Cek jika slug sudah ada, tambahkan angka untuk membuatnya unik
        $existingSlugCount = ServiceModel::where('slug', $slug)->count();
        if ($existingSlugCount > 0) {
            $slug .= '-' . ($existingSlugCount + 1);
        }

        return $slug;
    }
}
