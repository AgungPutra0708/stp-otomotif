<?php

namespace App\Http\Controllers\admin;

use App\Models\ServiceModel;

use App\Http\Controllers\Controller;
use App\Models\CarCatalogueServiceModel;
use App\Models\CategoryServiceModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $services = ServiceModel::with('category')->get();

            return DataTables::of($services)
                ->addIndexColumn()
                ->addColumn('category', function ($row) {
                    return $row->category ? $row->category->name : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    $encryptId = Crypt::encrypt($row->id);
                    $editUrl = route('services.edit', $encryptId);
                    $deleteUrl = route('services.destroy', $encryptId);

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

        return view('admin.services.index');
    }

    public function create()
    {
        $categoryData = CategoryServiceModel::all();
        $carData = CarCatalogueServiceModel::all();
        return view('admin.services.form', compact('categoryData', 'carData'));
    }

    public function store(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'name' => 'required|string',
                'category' => 'required',
                'car_id' => 'nullable', // Make car_id optional
            ]);

            // Proceed if validation is successful
            $service = new ServiceModel();
            $service->name = $request->name;
            $service->slug = ServiceModel::generateSlug($request->name);
            $service->category_services_id = Crypt::decrypt($request->category);
            $service->price = $request->price;
            $service->specification = $request->specification;

            // If car_id is provided, assign it
            if ($request->has('car_id')) {
                $service->car_id = Crypt::decrypt($request->car_id);
            }

            $service->save();

            return redirect()->route('services.index')->with('success', 'Service created successfully');
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
        $services = ServiceModel::findOrFail($id);
        $categoryData = CategoryServiceModel::all();
        $carData = CarCatalogueServiceModel::all(); // Get car data for the dropdown
        return view('admin.services.form', compact('services', 'categoryData', 'carData'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'name' => 'required|string',
                'category' => 'required',
                'car_id' => 'nullable', // Make car_id optional
            ]);

            // Proceed if validation is successful
            $service = ServiceModel::findOrFail($id);
            $service->name = $request->name;
            $service->slug = ServiceModel::generateSlug($request->name);
            $service->category_services_id = Crypt::decrypt($request->category);
            $service->price = $request->price;
            $service->specification = $request->specification;

            // If car_id is provided, assign it
            if ($request->has('car_id')) {
                $service->car_id = Crypt::decrypt($request->car_id);
            }

            $service->save();

            return redirect()->route('services.index')->with('success', 'Service updated successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors and return payload
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Handle any other exceptions (e.g., database-related)
            return redirect()->back()->with('error', 'An error occurred while saving the service: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $service = ServiceModel::findOrFail($id);
            $service->delete();

            return redirect()->route('services.index')->with('success', 'Service deleted successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors and return payload
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Handle any other exceptions (e.g., database-related)
            return redirect()->back()->with('error', 'An error occurred while saving the service: ' . $e->getMessage())->withInput();
        }
    }
}
