@extends('admin.layout.app')
@section('title', 'Car Catalog')
@section('content-admin')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-5 m-b-10">Car Catalog</h3>
                <div class="table-data__tool text-right">
                    <div class="table-data__tool-right">
                        <a class="au-btn au-btn-icon au-btn--blue au-btn--small text-white"
                            href="{{ route('carcatalog.create') }}">
                            <i class="zmdi zmdi-plus"></i>Add Car Catalog
                        </a>
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2" id="carcatalog-table">
                        <thead>
                            <tr>
                                <th>no</th>
                                <th>name</th>
                                <th>image</th>
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
            var table = $('#carcatalog-table').DataTable({
                processing: true,
                serverSide: true,
                lengthChange: false,
                searching: false,
                ajax: '{{ route('carcatalog.index') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'image_path',
                        name: 'image_path'
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
