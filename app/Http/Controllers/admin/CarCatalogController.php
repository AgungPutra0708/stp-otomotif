<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CarCatalogueServiceModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class CarCatalogController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $carcatalog = CarCatalogueServiceModel::all();

            return DataTables::of($carcatalog)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $encryptId = Crypt::encrypt($row->id);
                    $editUrl = route('carcatalog.edit', $encryptId);
                    $deleteUrl = route('carcatalog.destroy', $encryptId);

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

        return view('admin.carcatalog.index');

    }

    public function create()
    {
        $carcatalogData = CarCatalogueServiceModel::all();
        return view('admin.carcatalog.form', compact('carcatalogData'));
    }

    public function store(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'name' => 'required|string',
                'image_path' => 'required|string'
            ]);

            // Proceed if validation is successful
            $carcatalog = new CarCatalogueServiceModel();
            $carcatalog->name = $request->name;
            


            $carcatalog->save();

            return redirect()->route('carcatalog.index')->with('success', 'Car Catalogue created successfully');
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
        $carcatalogData = CarCatalogueServiceModel::all();
        $carcatalog = CarCatalogueServiceModel::findOrFail($id); // Ambil data spesifik berdasarkan ID
        return view('admin.carcatalog.form', compact( 'carcatalogData','carcatalog'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                // Validasi lainnya
            ]);

            $carcatalog = CarCatalogueServiceModel::findOrFail($id);

            // Update data produk
            $carcatalog->update([
                'name' => $request->name
                // Update data lainnya
            ]);

            return redirect()->route('carcatalog.index')->with('success', 'Car Catalog updated successfully');
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
            $carcatalog = CarCatalogueServiceModel::findOrFail($id);
            $carcatalog->delete();

            return redirect()->route('carcatalog.index')->with('success', 'Car Catalog deleted successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors and return payload
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Handle any other exceptions (e.g., database-related)
            return redirect()->back()->with('error', 'An error occurred while saving the categorys: ' . $e->getMessage())->withInput();
        }
    }
}