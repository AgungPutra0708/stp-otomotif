@extends('admin.layout.app')
@section('title', 'Category Products')
@section('content-admin')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ isset($categoryservices) ? 'Edit Category Services' : 'Create Category Services' }}
                    </div>
                    <div class="card-body card-block">
                        <form
                            action="{{ isset($categoryservices) ? route('categoryservices.update', $categoryservices->id) : route('categoryservices.store') }}"
                            method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            @if (isset($categoryservices))
                                @method('PUT')
                            @endif

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="name" class="form-control-label">Nama Category</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="name" name="name"
                                        value="{{ isset($categoryservices) ? $categoryservices->name : '' }}"
                                        placeholder="Masukkan Nama category" class="form-control">
                                </div>
                            </div>

                            
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> {{ isset($categoryservices) ? 'Update' : 'Submit' }}
                                </button>
                                <a type="button" class="btn btn-success btn-sm" href="{{ route('categoryservices.index') }}">
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
