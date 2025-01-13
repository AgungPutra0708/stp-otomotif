<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ProductImageModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = ProductModel::with('category')->select('products.*');

            return DataTables::of($products)
                ->addIndexColumn() // Menambahkan kolom nomor urut
                ->addColumn('category', function ($row) {
                    return $row->category->name;
                })
                ->addColumn('slug', function ($row) {
                    return $row->slug;
                })
                ->addColumn('status', function ($row) {
                    switch ($row->status) {
                        case 'ready':
                            return 'Produk Tersedia';
                        case 'soon':
                            return 'Segera Hadir';
                        case 'not_ready':
                            return 'Tidak Tersedia';
                        default:
                            return 'Status Tidak Diketahui';
                    }
                })
                ->addColumn('action', function ($row) {
                    $encryptId = Crypt::encrypt($row->id);
                    $editUrl = route('products.edit', $encryptId);
                    $deleteUrl = route('products.destroy', $encryptId);

                    return '
                    <a href="' . $editUrl . '" class="btn btn-sm btn-primary">
                        <i class="zmdi zmdi-edit"></i>
                    </a>
                    <form action="' . $deleteUrl . '" method="POST" style="display:inline;" onsubmit="return confirm(\'Yakin ingin menghapus produk ini?\')">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="zmdi zmdi-delete"></i>
                        </button>
                    </form>';
                })
                ->rawColumns(['action']) // Mengizinkan kolom action berisi HTML
                ->make(true);
        }

        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoryData = CategoryModel::all();
        return view('admin.product.form', compact('categoryData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'product_name' => 'required|string|max:255',
                'category' => 'required',
                'status' => 'required',
                'price' => 'required|numeric',
                'product_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
            ]);

            // Membuat slug berdasarkan nama produk
            $slug = ProductModel::generateSlug($request->product_name);

            // Simpan data produk ke database
            $product = ProductModel::create([
                'name' => $request->product_name,
                'slug' => $slug,
                'category_id' => Crypt::decrypt($request->category),
                'status' => $request->status,
                'price' => $request->price,
                'specification' => $request->specification,
            ]);

            // Cek apakah ada gambar yang diupload
            if ($request->hasFile('product_images')) {
                foreach ($request->file('product_images') as $image) {
                    $imageName = time() . '-' . $image->getClientOriginalName();
                    $imagePath = $image->storeAs('uploads/products', $imageName, 'public');

                    // Simpan data gambar ke database
                    $product->images()->create([
                        'image_path' => 'storage/' . $imagePath,
                    ]);
                }
            }

            return redirect()->route('products.index')->with('success', 'Product created successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $product = ProductModel::with('images')->findOrFail($id);
        $categoryData = CategoryModel::all(); // Mengambil semua kategori
        return view('admin.product.form', compact('product', 'categoryData'));
    }


    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'product_name' => 'required|string|max:255',
                'category' => 'required',
                'status' => 'required',
                'price' => 'required|numeric',
                'product_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
            ]);

            $product = ProductModel::findOrFail($id);

            // Membuat slug berdasarkan nama produk
            $slug = ProductModel::generateSlug($request->product_name);

            $existingProduct = ProductModel::where('slug', $slug)->where('id', '!=', $product->id)->first();
            if (!$existingProduct) {
                // Update data produk
                $product->update([
                    'name' => $request->product_name,
                    'slug' => $slug,
                    'category_id' => Crypt::decrypt($request->category),
                    'status' => $request->status,
                    'price' => $request->price,
                    'specification' => $request->specification,
                ]);
            } else {
                // Update data produk
                $product->update([
                    'name' => $request->product_name,
                    'category_id' => Crypt::decrypt($request->category),
                    'status' => $request->status,
                    'price' => $request->price,
                    'specification' => $request->specification,
                ]);
            }

            // Cek apakah ada gambar baru yang diupload
            if ($request->hasFile('product_images')) {
                // Hapus gambar lama
                foreach ($product->images as $image) {
                    $imagePath = public_path($image->image_path);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                    $image->delete();
                }

                // Upload dan simpan gambar baru
                foreach ($request->file('product_images') as $image) {
                    $imageName = time() . '-' . $image->getClientOriginalName();
                    $imagePath = $image->storeAs('uploads/products', $imageName, 'public');

                    // Simpan data gambar ke database
                    $product->images()->create([
                        'image_path' => 'storage/' . $imagePath,
                    ]);
                }
            }

            return redirect()->route('products.index')->with('success', 'Product updated successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $product = ProductModel::with('images')->findOrFail($id);

        // Hapus semua gambar yang terkait dengan produk
        foreach ($product->images as $image) {
            $imagePath = public_path($image->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Hapus file gambar dari direktori
            }
            $image->delete(); // Hapus data gambar dari database
        }

        // Hapus data produk
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus');
    }
    public function removeImage($id)
    {
        $image = ProductImageModel::findOrFail($id);

        // Hapus file fisik
        if (file_exists(public_path($image->image_path))) {
            unlink(public_path($image->image_path));
        }

        // Hapus data dari database
        $image->delete();

        return back()->with('success', 'Gambar berhasil dihapus');
    }
}
