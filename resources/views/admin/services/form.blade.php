@extends('admin.layout.app')
@section('title', 'Services')
@section('content-admin')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ isset($services) ? 'Edit Services' : 'Create Services' }}
                    </div>
                    <div class="card-body card-block">
                        <form
                            action="{{ isset($services) ? route('services.update', $services->id) : route('services.store') }}"
                            method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            @if (isset($services))
                                @method('PUT')
                            @endif

                            <!-- For name field -->
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="service_name" class="form-control-label">Nama Service</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="service_name" name="name"
                                        value="{{ old('name', isset($services) ? $services->name : '') }}"
                                        placeholder="Masukkan Nama Service" class="form-control">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- For category field -->
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="category" class="form-control-label">Pilih Kategori</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Silahkan Pilih</option>
                                        @foreach ($categoryData as $item)
                                            <option value="{{ Crypt::encrypt($item->id) }}"
                                                {{ old('category', isset($services) ? $services->category_services_id : '') == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- For car field -->
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="car" class="form-control-label">Pilih Kendaraan</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="car_id" id="car" class="form-control">
                                        <option value="">Silahkan Pilih</option>
                                        @foreach ($carData as $item)
                                            <option value="{{ Crypt::encrypt($item->id) }}"
                                                {{ old('car_id', isset($services) ? $services->car_id : '') == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('car_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="price" class="form-control-label">Harga Service</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="price" name="price"
                                        value="{{ isset($services) ? $services->price : '' }}"
                                        placeholder="Masukkan Harga Service" class="form-control">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="specification" class="form-control-label">Spesifikasi</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <textarea name="specification" id="specification" rows="9" placeholder="Masukkan Spesifikasi"
                                        class="form-control">{{ isset($services) ? $services->specification : '' }}</textarea>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> {{ isset($services) ? 'Update' : 'Submit' }}
                                </button>
                                <a type="button" class="btn btn-success btn-sm" href="{{ route('services.index') }}">
                                    <i class="fa fa-step-backward"></i> Back
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Check if the category is Konversi
            $('#category').on('change', function() {
                var category = $(this).find('option:selected')
                    .text().trim(); // Get the text of the selected option
                console.log(category); // Log the selected category for debugging

                // If "Konversi" is selected, enable the car selection
                if (category == 'Konversi') {
                    $('#car').prop('disabled', false); // Enable the car dropdown
                } else {
                    $('#car').prop('disabled', true); // Disable the car dropdown
                }
            }).trigger('change'); // Trigger change event on page load to set the initial state
        });
    </script>
@endsection
