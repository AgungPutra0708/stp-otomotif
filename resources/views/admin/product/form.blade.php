@extends('admin.layout.app')
@section('title', 'Products')
@section('content-admin')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ isset($product) ? 'Edit Product' : 'Create Product' }}
                    </div>
                    <div class="card-body card-block">
                        <form
                            action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}"
                            method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            @if (isset($product))
                                @method('PUT')
                            @endif

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="product_name" class="form-control-label">Nama Produk</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="product_name" name="product_name"
                                        value="{{ isset($product) ? $product->name : '' }}"
                                        placeholder="Masukkan Nama Produk" class="form-control">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="category" class="form-control-label">Pilih Kategori</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Silahkan Pilih</option>
                                        @foreach ($categoryData as $item)
                                            <option value="{{ Crypt::encrypt($item->id) }}"
                                                {{ isset($product) && $product->category_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="status" class="form-control-label">Pilih Status</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Silahkan Pilih</option>
                                        <option value="ready"
                                            {{ isset($product) && $product->status == 'ready' ? 'selected' : '' }}>Tersedia
                                        </option>
                                        <option value="soon"
                                            {{ isset($product) && $product->status == 'soon' ? 'selected' : '' }}>Segera
                                            Hadir</option>
                                        <option value="not_ready"
                                            {{ isset($product) && $product->status == 'not_ready' ? 'selected' : '' }}>Tidak
                                            Tersedia</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="price" class="form-control-label">Harga Produk</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="price" name="price"
                                        value="{{ isset($product) ? $product->price : '' }}"
                                        placeholder="Masukkan Harga Produk" class="form-control">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="specification" class="form-control-label">Spesifikasi</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <textarea name="specification" id="specification" rows="9" placeholder="Masukkan Spesifikasi"
                                        class="form-control">{{ isset($product) ? $product->specification : '' }}</textarea>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="product_images" class="form-control-label">Foto Produk</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="file" id="product_images" name="product_images[]" multiple
                                        class="form-control-file">
                                </div>
                            </div>

                            <!-- Menampilkan gambar yang sudah ada -->
                            @if (isset($product) && $product->images->count() > 0)
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="existing_images" class="form-control-label">Gambar Saat Ini</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        @foreach ($product->images as $image)
                                            <div class="mb-3">
                                                <img src="{{ asset($image->image_path) }}" alt="Product Image"
                                                    width="100">
                                                <a href="{{ route('products.removeImage', $image->id) }}"
                                                    class="btn btn-danger btn-sm">Hapus</a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> {{ isset($product) ? 'Update' : 'Submit' }}
                                </button>
                                <a type="button" class="btn btn-success btn-sm" href="{{ route('products.index') }}">
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
