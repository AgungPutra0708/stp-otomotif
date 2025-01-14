@extends('admin.layout.app')
@section('title', 'Category Products')
@section('content-admin')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ isset($category) ? 'Edit Category' : 'Create Category' }}
                    </div>
                    <div class="card-body card-block">
                        <form
                            action="{{ isset($category) ? route('categorys.update', $category->id) : route('categorys.store') }}"
                            method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            @if (isset($category))
                                @method('PUT')
                            @endif

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="name" class="form-control-label">Nama Category</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="name" name="name"
                                        value="{{ isset($category) ? $category->name : '' }}"
                                        placeholder="Masukkan Nama category" class="form-control">
                                </div>
                            </div>

                            
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> {{ isset($category) ? 'Update' : 'Submit' }}
                                </button>
                                <a type="button" class="btn btn-success btn-sm" href="{{ route('categorys.index') }}">
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
