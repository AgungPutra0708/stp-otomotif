@extends('admin.layout.app')
@section('title', 'Car Catalog')
@section('content-admin')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ isset($carcatalog) ? 'Edit Car Catalog' : 'Create Car Catalog' }}
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
                                    <label for="name" class="form-control-label">Nama Car</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="name" name="name"
                                        value="{{ isset($carcatalog) ? $carcatalog->name : '' }}"
                                        placeholder="Masukkan Nama mobil" class="form-control">
                                </div>

                                <div class="col col-md-3">
                                    <label for="iamge_path" class="form-control-label">Gambar</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="file" id="image_path" name="image_path"
                                        value="{{ isset($carcatalog) ? $carcatalog->image_path : '' }}"
                                        class="form-control">
                                </div>
                            </div>

                            
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
