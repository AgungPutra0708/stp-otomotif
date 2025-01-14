<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class CategorysProductController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $categorys = CategoryModel::all();

            return DataTables::of($categorys)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $encryptId = Crypt::encrypt($row->id);
                    $editUrl = route('categorys.edit', $encryptId);
                    $deleteUrl = route('categorys.destroy', $encryptId);

                    return '
                        <a href="' . $editUrl . '" class="btn btn-sm btn-primary">
                            <i class="zmdi zmdi-edit"></i>
                        </a>
                        <form action="' . $deleteUrl . '" method="POST" style="display:inline;" onsubmit="return confirm(\'Are you sure you want to delete?\')">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="zmdi zmdi-delete"></i>
                            </button>
                        </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.categorys.index');
    }

    public function create()
    {
        $categoryData = CategoryModel::all();
        return view('admin.categorys.form', compact('categoryData'));
    }

    public function store(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'name' => 'required|string'
            ]);

            // Proceed if validation is successful
            $category = new CategoryModel();
            $category->name = $request->name;
            


            $category->save();

            return redirect()->route('categorys.index')->with('success', 'Category Product created successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors and return payload
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Handle any other exceptions (e.g., database-related)
            return redirect()->back()->with('error', 'An error occurred while saving the service: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $categoryData = CategoryModel::all();
        $category = CategoryModel::findOrFail($id); // Ambil data spesifik berdasarkan ID
        return view('admin.categorys.form', compact( 'categoryData','category'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                // Validasi lainnya
            ]);

            $category = CategoryModel::findOrFail($id);

            // Update data produk
            $category->update([
                'name' => $request->name
                // Update data lainnya
            ]);

            return redirect()->route('categorys.index')->with('success', 'Categorys updated successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return redirect()->back()->with('error', $e->errors());
        } catch (\Exception $e) {
            // Handle any other exceptions (e.g., database-related)
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    

    public function destroy($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $category = CategoryModel::findOrFail($id);
            $category->delete();

            return redirect()->route('categorys.index')->with('success', 'Categorys deleted successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors and return payload
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Handle any other exceptions (e.g., database-related)
            return redirect()->back()->with('error', 'An error occurred while saving the categorys: ' . $e->getMessage())->withInput();
        }
    }
}