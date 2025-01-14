<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryServiceModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class CategoryServicesController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $categoryservices = CategoryServiceModel::all();

            return DataTables::of($categoryservices)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $encryptId = Crypt::encrypt($row->id);
                    $editUrl = route('categoryservices.edit', $encryptId);
                    $deleteUrl = route('categoryservices.destroy', $encryptId);

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

        return view('admin.categoryservices.index');

    }

    public function create()
    {
        $categoryData = CategoryServiceModel::all();
        return view('admin.categoryservices.form', compact('categoryData'));
    }

    public function store(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'name' => 'required|string'
            ]);

            // Proceed if validation is successful
            $categoryservice = new CategoryServiceModel();
            $categoryservice->name = $request->name;
            


            $categoryservice->save();

            return redirect()->route('categoryservices.index')->with('success', 'Category Service created successfully');
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
        $categoryData = CategoryServiceModel::all();
        $categoryservices = CategoryServiceModel::findOrFail($id); // Ambil data spesifik berdasarkan ID
        return view('admin.categoryservices.form', compact( 'categoryData','categoryservices'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                // Validasi lainnya
            ]);

            $categoryservice = CategoryServiceModel::findOrFail($id);

            // Update data produk
            $categoryservice->update([
                'name' => $request->name
                // Update data lainnya
            ]);

            return redirect()->route('categoryservices.index')->with('success', 'Categorys Services updated successfully');
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
            $categoryservices = CategoryServiceModel::findOrFail($id);
            $categoryservices->delete();

            return redirect()->route('categoryservices.index')->with('success', 'Category Services deleted successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors and return payload
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Handle any other exceptions (e.g., database-related)
            return redirect()->back()->with('error', 'An error occurred while saving the categorys: ' . $e->getMessage())->withInput();
        }
    }
}