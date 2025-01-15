<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            // Mengambil data order beserta detailnya
            $orders = Order::with('orderDetails')->get();

            return datatables()->of($orders)
                ->addIndexColumn() // Menambahkan kolom nomor urut
                ->addColumn('product_name', function ($order) {
                    // Menggabungkan nama produk atau layanan dari orderDetails
                    $productNames = $order->orderDetails->map(function ($detail) {
                        if ($detail->type === 'product') {
                            return optional($detail->product)->name; // Mengambil nama produk
                        } elseif ($detail->type === 'service') {
                            return optional($detail->service)->name; // Mengambil nama layanan
                        }
                        return null;
                    })->filter()->implode(', '); // Menghapus null dan menggabungkan dengan koma

                    return $productNames;
                })
                ->addColumn('customer_name', function ($order) {
                    // Menggabungkan jumlah kuantitas dari orderDetails
                    return $order->name;
                })
                ->addColumn('qty', function ($order) {
                    // Menggabungkan jumlah kuantitas dari orderDetails
                    return $order->orderDetails->sum('quantity');
                })
                ->addColumn('price', function ($order) {
                    // Menghitung total harga dari semua produk atau layanan dengan format Rp
                    $totalPrice = $order->orderDetails->sum(function ($detail) {
                        return $detail->quantity * $detail->price;
                    });

                    return 'Rp ' . number_format($totalPrice, 0, ',', '.');
                })
                ->addColumn('action', function ($row) {
                    $encryptId = Crypt::encrypt($row->id);
                    $editUrl = route('sales.edit', $encryptId);

                    return '
                    <a href="' . $editUrl . '" class="btn btn-sm btn-primary">
                        <i class="zmdi zmdi-edit"></i>
                    </a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.sales.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        $id = Crypt::decrypt($id);
        $order = Order::with('orderDetails')->findOrFail($id);
        return view('admin.sales.form', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
