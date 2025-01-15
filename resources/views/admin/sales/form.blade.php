@extends('admin.layout.app')
@section('title', 'Order Details')
@section('content-admin')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Details Order
                    </div>
                    <div class="card-body card-block">
                        <!-- Order Information -->
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="customer_name" class="form-control-label">Nama Customer</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="customer_name" name="customer_name" value="{{ $order->name }}"
                                    class="form-control" readonly>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="order_date" class="form-control-label">Tanggal Order</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="order_date" name="order_date"
                                    value="{{ $order->created_at->format('d-m-Y') }}" class="form-control" readonly>
                            </div>
                        </div>

                        <!-- Order Details Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered" id="order-details-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis</th>
                                        <th>Nama Produk/Jasa</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderDetails as $index => $detail)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $detail->type === 'service' ? 'Service' : 'Product' }}</td>
                                            <td>
                                                <!-- Display Product Name or Service Name -->
                                                @if ($detail->type === 'service')
                                                    {{ $detail->service->name ?? '-' }} <!-- Ensure service exists -->
                                                @else
                                                    {{ $detail->product->name ?? '-' }} <!-- Ensure product exists -->
                                                @endif
                                            </td>
                                            <td>{{ $detail->quantity }}</td>
                                            <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                                            <td>Rp {{ number_format($detail->quantity * $detail->price, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" class="text-right">Total Keseluruhan</th>
                                        <th>Rp
                                            {{ number_format(
                                                $order->orderDetails->sum(function ($detail) {
                                                    return $detail->quantity * $detail->price;
                                                }),
                                                0,
                                                ',',
                                                '.',
                                            ) }}
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="card-footer">
                            <a type="button" class="btn btn-success btn-sm" href="{{ route('sales.index') }}">
                                <i class="fa fa-step-backward"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
