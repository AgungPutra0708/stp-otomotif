@extends('admin.layout.app')
@section('title', 'Kendaraan')
@section('content-admin')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ isset($carcatalog) ? 'Edit Kendaraan' : 'Create Kendaraan' }}
                    </div>
                    <div class="card-body card-block">
                        <form
                            action="{{ isset($carcatalog) ? route('carcatalog.update', $carcatalog->id) : route('carcatalog.store') }}"
                            method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            @if (isset($carcatalog))
                                @method('PUT')
                            @endif

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="name" class="form-control-label">Nama Kendaraan</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="name" name="name"
                                        value="{{ isset($carcatalog) ? $carcatalog->name : '' }}"
                                        placeholder="Masukkan Nama Kendaraan" class="form-control">
                                </div>

                                <div class="col col-md-3">
                                    <label for="image_path" class="form-control-label">Foto Kendaraan</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="file" id="image_path" name="image_path"
                                        class="form-control-file">
                                </div>
                            </div>

                            <!-- Menampilkan gambar yang sudah ada -->
                            @if (isset($carcatalog) && $carcatalog->image_path)
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="image_path" class="form-control-label">Gambar Saat Ini</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <div class="mb-3">
                                            <img src="{{ asset($carcatalog->image_path) }}" alt="Product Image"
                                                width="100">
                                        </div>
                                    </div>
                                </div>
                            @endif


                            
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> {{ isset($carcatalog) ? 'Update' : 'Submit' }}
                                </button>
                                <a type="button" class="btn btn-success btn-sm" href="{{ route('carcatalog.index') }}">
                                    <i class="fa fa-step-backward"></i> Back
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
