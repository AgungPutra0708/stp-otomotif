@extends('admin.layout.app')
@section('title', 'Sales')
@section('content-admin')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-5 m-b-10">Sales</h3>
                {{-- <div class="table-data__tool text-right">
                    <div class="table-data__tool-right">
                        <a class="au-btn au-btn-icon au-btn--blue au-btn--small text-white"
                            href="{{ route('sales.create') }}">
                            <i class="zmdi zmdi-plus"></i>Add Sales
                        </a>
                    </div>
                </div> --}}
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2" id="sales-table">
                        <thead>
                            <tr>
                                <th>no</th>
                                <th>product/service name</th>
                                <th>customer name</th>
                                <th>qty</th>
                                <th>price</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            var table = $('#sales-table').DataTable({
                processing: true,
                serverSide: true,
                lengthChange: false,
                searching: false,
                ajax: '{{ route('sales.index') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'product_name',
                        name: 'product_name'
                    },
                    {
                        data: 'customer_name',
                        name: 'customer_name'
                    },
                    {
                        data: 'qty',
                        name: 'qty'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endsection
