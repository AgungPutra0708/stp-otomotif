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

                <!-- Qty Input Field and Buttons (Add to Cart and Order Now) -->
                <div class="d-flex align-items-center mt-3">
                    <button type="button" class="btn btn-outline-secondary btn-sm qty-btn" onclick="changeQty(this, -1)"
                        style="height: 38px;">-</button>
                    <input type="number" class="form-control qty-input mx-2" value="1" min="1" id="qtyDetail"
                        style="width: 60px;">
                    <button type="button" class="btn btn-outline-secondary btn-sm qty-btn" onclick="changeQty(this, 1)"
                        style="height: 38px;">+</button>

                    <!-- Button Group for Add to Cart and Order Now -->
                    <div class="ms-3">
                        <button type="button" class="btn btn-primary" onclick="addToCart({{ $productData->id }})"
                            style="height: 38px;"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Blog End -->
    </div>

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
                        type: 'product',
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
