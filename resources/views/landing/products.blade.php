@extends('landing.layout.app')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Product</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a href="{{ route('home') }}">Home</a></h6>
            <h6 class="text-white m-0 px-3">/</h6>
            <h6 class="text-uppercase text-white m-0">Product</h6>
        </div>
    </div>
    <!-- Page Header Start -->

    <!-- Portfolio Start -->
    <div class="container-fluid bg-light py-6 px-5">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 text-uppercase mb-4">Some Of Our <span class="text-primary">Popular</span> Product</h1>
        </div>
        <div class="row gx-5">
            <div class="col-12 text-center">
                <div class="d-inline-block bg-dark-radial text-center pt-4 px-5 mb-5">
                    <ul class="list-inline mb-0" id="portfolio-flters">
                        <li class="btn btn-outline-primary bg-white p-2 active mx-2 mb-4" data-filter="*">
                            <img src="{{ asset('assets-landing/img/portfolio-1.jpg') }}"
                                style="width: 150px; height: 100px;">
                            <div class="position-absolute top-0 start-0 end-0 bottom-0 m-2 d-flex align-items-center justify-content-center"
                                style="background: rgba(4, 15, 40, .3);">
                                <h6 class="text-white text-uppercase m-0">All</h6>
                            </div>
                        </li>

                        @foreach ($categoryData as $item)
                            <li class="btn btn-outline-primary bg-white p-2 mx-2 mb-4" data-filter=".{{ $item->slug }}">
                                <img src="{{ asset('assets-landing/img/portfolio-1.jpg') }}"
                                    style="width: 150px; height: 100px;">
                                <div class="position-absolute top-0 start-0 end-0 bottom-0 m-2 d-flex align-items-center justify-content-center"
                                    style="background: rgba(4, 15, 40, .3);">
                                    <h6 class="text-white text-uppercase m-0">{{ $item->name }}</h6>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="row g-5 portfolio-container">
            @foreach ($productData as $item)
                <div class="col-xl-4 col-lg-6 col-md-6 portfolio-item {{ $item->category_slug }}">
                    <div class="position-relative portfolio-box">
                        {{-- Ambil gambar pertama dari relasi images --}}
                        <img class="img-fluid w-100"
                            src="{{ asset($item->images->first()->image_path ?? 'assets-landing/img/default.jpg') }}"
                            alt="{{ $item->name }}" style="max-height: 350px">

                        <a class="portfolio-title shadow-sm" href="{{ route('product.details', $item->slug) }}">
                            <h4 class="text-uppercase mb-2">{{ $item->name }}</h4>
                            <h6 class="text-uppercase mb-2">{{ $item->category->name }}</h6>
                            <span class="text-body">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </span>
                        </a>

                        <a class="portfolio-btn"
                            href="{{ asset($item->images->first()->image_path ?? 'assets-landing/img/default.jpg') }}"
                            data-lightbox="portfolio">
                            <i class="bi bi-arrows-fullscreen text-white fs-2"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination Start -->
        <div class="d-flex justify-content-center mt-4">
            {{ $productData->links('pagination::bootstrap-5') }}
        </div>
        <!-- Pagination End -->
    </div>
    <!-- Portfolio End -->
@endsection
