<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarCatalogueServiceModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "car_catalogues";

    protected $guarded = [];
}
