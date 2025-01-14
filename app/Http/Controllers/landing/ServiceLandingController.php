<?php

namespace App\Http\Controllers\landing;

use App\Http\Controllers\Controller;
use App\Models\CategoryServiceModel;
use App\Models\ServiceModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceLandingController extends Controller
{
    public function index()
    {
        $categoryData = CategoryServiceModel::all()->map(function ($category) {
            $category->slug = Str::slug($category->name); // Membuat slug dari name
            return $category;
        });
        $serviceData = ServiceModel::with(['category'])->orderBy('id', 'desc')->paginate(9);
        $serviceData->map(function ($product) {
            $product->category_slug = Str::slug($product->category->name); // Membuat slug dari name category
            return $product;
        });
        return view('landing.services', compact('categoryData', 'serviceData'));
    }

    public function show($segment)
    {
        $categoryData = CategoryServiceModel::all()->map(function ($category) {
            $category->slug = Str::slug($category->name); // Membuat slug dari name
            return $category;
        });
        $serviceData = ServiceModel::with(['category'])->where('slug', $segment)->first();
        $serviceData->category_slug = Str::slug($serviceData->category->name); // Membuat slug dari name category
        return view('landing.service-details', compact('categoryData', 'serviceData'));
    }
}
