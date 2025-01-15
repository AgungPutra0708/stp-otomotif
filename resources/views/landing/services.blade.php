@extends('landing.layout.app')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Product</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a href="{{ route('home') }}">Home</a></h6>
            <h6 class="text-white m-0 px-3">/</h6>
            <h6 class="text-uppercase text-white m-0">Services</h6>
        </div>
    </div>
    <!-- Page Header Start -->

    <!-- Services Start -->
    <div class="container-fluid bg-light py-6 px-5">
        <div class="row gx-5">
            <div class="col-12 text-center">
                <div class="mb-5">
                    <h1 class="display-5 text-uppercase mb-4">We Provide <span class="text-primary">The Best</span> Services
                    </h1>
                    <div class="d-flex flex-wrap justify-content-center m-n1">
                        <button type="button" class="btn btn-outline-dark m-1" data-filter="*">All</button>
                        @foreach ($categoryData as $item)
                            <button type="button" class="btn btn-outline-dark m-1"
                                data-filter=".{{ $item->slug }}">{{ $item->name }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-light py-6 px-5">
            <div class="row g-5 service-container">
                @foreach ($serviceData as $item)
                    <div class="col-lg-4 col-md-6 {{ $item->category_slug }}">
                        <div class="service-item bg-white d-flex flex-column align-items-center text-center">
                            <div class="service-icon bg-white">
                                <i class="fa fa-3x fa-tools text-primary"></i>
                            </div>
                            <div class="px-4 pb-4">
                                <a href="{{ route('service.details', $item->slug) }}">
                                    <h4 class="text-uppercase mb-3">{{ $item->name }}</h4>
                                    <h6 class="text-uppercase mb-2">{{ $item->category->name }}</h6>
                                    <p>Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                </a>
                                <!-- Qty Input Field with Add to Cart Button -->
                                <div class="d-flex justify-content-center mt-3">
                                    <button type="button" class="btn btn-outline-secondary btn-sm qty-btn"
                                        onclick="changeQty(this, -1)" style="height: 38px;">-</button>
                                    <input type="number" class="form-control qty-input mx-2" value="1" min="1"
                                        data-id="{{ $item->id }}" style="width: 60px;">
                                    <button type="button" class="btn btn-outline-secondary btn-sm qty-btn"
                                        onclick="changeQty(this, 1)" style="height: 38px;">+</button>
                                    <button type="button" class="btn btn-primary ms-2"
                                        onclick="addToCart({{ $item->id }})" style="height: 38px;"><i
                                            class="fa fa-shopping-cart" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Services End -->

    <!-- Pagination Start -->
    <!-- Pagination End -->
    <!-- Portfolio End -->
    <script>
        function changeQty(element, delta) {
            let input = element.parentElement.querySelector('.qty-input');
            let currentQty = parseInt(input.value) || 1;
            let newQty = currentQty + delta;
            input.value = newQty > 0 ? newQty : 1;
        }

        function addToCart(productId) {
            let qtyInput = document.querySelector(`.qty-input[data-id="${productId}"]`);
            let qty = qtyInput ? qtyInput.value : 1;

            fetch('/cart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        type: 'service',
                        quantity: qty
                    })
                })
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Succees',
                        text: data.message,
                        confirmButtonText: 'OK'
                    });
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to add product to cart, Please Login First',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = '{{ route('login') }}';
                    });
                });
        }
    </script>
@endsection
