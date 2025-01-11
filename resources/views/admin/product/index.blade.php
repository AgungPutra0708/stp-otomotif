@extends('admin.layout.app')
@section('title', 'Products')
@section('content-admin')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <h3 class="title-5 m-b-10">Products</h3>
                <div class="table-data__tool text-right">
                    <div class="table-data__tool-right">
                        <a class="au-btn au-btn-icon au-btn--blue au-btn--small text-white"
                            href="{{ route('products.create') }}">
                            <i class="zmdi zmdi-plus"></i>add item
                        </a>
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2" id="products-table">
                        <thead>
                            <tr>
                                <th>no</th>
                                <th>category</th>
                                <th>status</th>
                                <th>name</th>
                                <th>slug</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#products-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('products.index') }}',
                lengthChange: false,
                searching: false,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'slug',
                        name: 'slug'
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
