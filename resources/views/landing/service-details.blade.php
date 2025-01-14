@extends('landing.layout.app')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Service</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a href="{{ route('home') }}">Home</a></h6>
            <h6 class="text-white m-0 px-3">/</h6>
            <h6 class="text-uppercase text-white m-0">Service</h6>
            <h6 class="text-white m-0 px-3">/</h6>
            <h6 class="text-uppercase text-white m-0">{{ $serviceData->name }}</h6>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Blog Start -->
    <div class="container-fluid py-6 px-5 d-flex justify-content-center align-items-center">
        <div class="row g-5">
            <div class="col-lg-12 d-flex flex-column align-items-center text-center">
                <!-- Service Detail Start -->
                <div>
                    <h1 class="text-uppercase mb-2">{{ $serviceData->name }}</h1>
                    <h2 class="text-uppercase mb-4">Rp {{ number_format($serviceData->price, 0, ',', '.') }}</h2>
                    <p>{{ $serviceData->specification }}</p>
                </div>
                <!-- Service Detail End -->

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
                        <button type="button" class="btn btn-primary" onclick="addToCart({{ $serviceData->id }})"
                            style="height: 38px;"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function changeQty(element, delta) {
            let input = element.parentElement.querySelector('.qty-input');
            let currentQty = parseInt(input.value) || 1;
            let newQty = currentQty + delta;
            input.value = newQty > 0 ? newQty : 1;
        }

        function addToCart(serviceId) {
            let qtyInput = document.querySelector(`.qty-input[data-id="${serviceId}"]`);
            let qty = qtyInput ? qtyInput.value : 1;

            fetch('/cart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        service_id: serviceId,
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
                    console.error('Error:', error);
                });
        }
    </script>
@endsection
