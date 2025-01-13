<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImageModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "product_images";

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }
}
