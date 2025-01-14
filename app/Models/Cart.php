<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = "cart";

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }

    public function service()
    {
        return $this->belongsTo(ServiceModel::class, 'service_id');
    }
}
