@extends('landing.layout.app')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Product</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a href="{{ route('home') }}">Home</a></h6>
            <h6 class="text-white m-0 px-3">/</h6>
            <h6 class="text-uppercase text-white m-0">Product</h6>
            <h6 class="text-white m-0 px-3">/</h6>
            <h6 class="text-uppercase text-white m-0">{{ $productData->name }}</h6>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Blog Start -->
    <div class="container-fluid py-6 px-5">
        <div class="row g-5">
            <div class="col-lg-5">
                <!-- Product Images Start -->
                <div class="container">
                    <div id="product-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($productData->images as $item)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <img class="img-fluid w-100 rounded mb-0"
                                        src="{{ asset($item->image_path ?? 'assets-landing/img/default.jpg') }}"
                                        alt="Image" style="object-fit: cover; max-height: 500px;">
                                </div>
                            @endforeach
                        </div>

                        <!-- Carousel Controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#product-carousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#product-carousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <!-- Product Images End -->
            </div>
            <div class="col-lg-7 d-flex flex-column justify-content-between">
                <!-- Product Detail Start -->
                <div>
                    <h1 class="text-uppercase mb-2">{{ $productData->name }}</h1>
                    <h2 class="text-uppercase mb-4">Rp {{ number_format($productData->price, 0, ',', '.') }}</h2>
                    <p>{{ $productData->specification }}</p>
                </div>
                <!-- Product Detail End -->

                <!-- Order Now Button (Always at the bottom) -->
                <button type="button" class="btn btn-primary mt-3 w-25 align-self-center" data-bs-toggle="modal"
                    data-bs-target="#orderModal">
                    Pesan Sekarang
                </button>
            </div>
        </div>
        <!-- Blog End -->
    </div>

    <!-- Modal for Order Form -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Order Now</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @csrf
                        <!-- Hidden Product Info -->
                        <input type="hidden" name="product_name" value="{{ $productData->name }}">
                        <input type="hidden" name="product_price" value="{{ $productData->price }}">
                        <input type="hidden" name="product_id" value="{{ $productData->id }}">

                        <!-- Customer Info -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="4"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100">Send Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
