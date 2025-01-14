<?php

namespace App\Http\Controllers\landing;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ProductLandingController extends Controller
{
    public function index()
    {
        $categoryData = CategoryModel::all()->map(function ($category) {
            $category->slug = Str::slug($category->name); // Membuat slug dari name
            return $category;
        });
        $productData = ProductModel::with(['category', 'images'])->orderBy('id', 'desc')->paginate(9);
        $productData->map(function ($product) {
            $product->category_slug = Str::slug($product->category->name); // Membuat slug dari name category
            return $product;
        });
        return view('landing.products', compact('categoryData', 'productData'));
    }

    public function show($segment)
    {
        $categoryData = CategoryModel::all()->map(function ($category) {
            $category->slug = Str::slug($category->name); // Membuat slug dari name
            return $category;
        });
        $productData = ProductModel::with(['category', 'images'])->where('slug', $segment)->first();
        $productData->category_slug = Str::slug($productData->category->name); // Membuat slug dari name category
        return view('landing.product-details', compact('categoryData', 'productData'));
    }

    public function submitOrder(Request $request)
    {
        // Validasi input form
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'required|string|max:15',
            'address' => 'required|string',
            'message' => 'nullable|string',
        ]);

        // Data untuk email
        $data = [
            'product_name'  => $request->input('product_name'),
            'product_price' => $request->input('product_price'),
            'name'          => $request->input('name'),
            'email'         => $request->input('email'),
            'phone'         => $request->input('phone'),
            'address'       => $request->input('address'),
            'pesan'       => $request->input('pesan'),
        ];

        // dd($data);

        // Kirim email
        Mail::send('landing.email.order-product', $data, function ($messages) use ($request) {
            $messages->from('sangmoduser@gmail.com', 'Order System');
            $messages->to($request->input('email'))
                ->subject('Order Confirmation');
        });

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Order has been sent successfully!');
    }
}
