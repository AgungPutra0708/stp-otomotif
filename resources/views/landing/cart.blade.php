@extends('landing.layout.app')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Cart</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a href="{{ route('home') }}">Home</a></h6>
            <h6 class="text-white m-0 px-3">/</h6>
            <h6 class="text-uppercase text-white m-0">Cart</h6>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Cart Table Start -->
    <div class="container-fluid py-6 px-5">
        <div class="row g-5">
            <div class="table-responsive">
                <table class="table table-bordered" id="cartTable">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $item)
                            <tr data-id="{{ $item->id }}">
                                <td>{{ $item->product->name }}</td>
                                <td class="price">Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <button type="button" class="btn btn-outline-secondary btn-sm qty-btn"
                                            onclick="changeQty(this, -1)" style="height: 38px">-</button>
                                        <input type="number" class="form-control qty-input mx-2"
                                            value="{{ $item->quantity }}" min="1" id="qty_{{ $item->id }}"
                                            style="width: 60px;">
                                        <button type="button" class="btn btn-outline-secondary btn-sm qty-btn"
                                            onclick="changeQty(this, 1)" style="height: 38px">+</button>
                                    </div>
                                </td>
                                <td class="total">Rp
                                    {{ number_format($item->quantity * $item->product->price, 0, ',', '.') }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="removeFromCart({{ $item->id }})"><i class="fa fa-trash"
                                            aria-hidden="true"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Order Now Button -->
        <div class="d-flex justify-content-center mt-4">
            <button type="button" class="btn btn-primary w-25" data-bs-toggle="modal" data-bs-target="#orderModal"
                onclick="setOrderData()">
                Pesan Sekarang
            </button>
        </div>
    </div>
    <!-- Cart Table End -->

    <!-- Modal for Order Form -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Order Now</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('order.submit') }}" method="POST">
                        @csrf
                        <!-- Hidden Product Info -->
                        <div id="cartItems"></div> <!-- This will hold the cart items as hidden inputs -->

                        <!-- Customer Info -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ Auth::user()->name }}" readonly required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ Auth::user()->email }}" readonly required>
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
                            <label for="pesan" class="form-label">Message</label>
                            <textarea class="form-control" id="pesan" name="pesan" rows="4"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100">Send Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Set cart data into modal
        function setOrderData() {
            let cartItemsDiv = document.getElementById('cartItems');
            cartItemsDiv.innerHTML = ''; // Clear previous items

            // Loop through cart items and add them as hidden inputs
            @foreach ($carts as $item)
                let productName = "{{ $item->product->name }}";
                let productPrice = "{{ $item->product->price }}";
                let productQuantity = document.querySelector(`#qty_{{ $item->id }}`).value;

                let hiddenProductData = `
                    <input type="hidden" name="products[{{ $item->id }}][name]" value="${productName}">
                    <input type="hidden" name="products[{{ $item->id }}][price]" value="${productPrice}">
                    <input type="hidden" name="products[{{ $item->id }}][quantity]" value="${productQuantity}">
                `;
                cartItemsDiv.innerHTML += hiddenProductData;
            @endforeach
        }

        // Update Quantity
        function changeQty(element, delta) {
            let input = element.parentElement.querySelector('.qty-input');
            let currentQty = parseInt(input.value) || 1;
            let newQty = currentQty + delta;
            input.value = newQty > 0 ? newQty : 1;

            // Update total in the row
            let row = element.closest('tr');
            let price = parseInt(row.querySelector('.price').innerText.replace('Rp ', '').replace('.', ''));
            let total = price * newQty;
            row.querySelector('.total').innerText = `Rp ${total.toLocaleString()}`;

            // Send the updated quantity to the server
            let cartId = row.getAttribute('data-id');
            updateCart(cartId, newQty);
        }

        // Update cart data
        function updateCart(cartId, quantity) {
            fetch(`/cart/update/${cartId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        quantity: quantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message,
                        confirmButtonText: 'OK'
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        // Remove from Cart
        function removeFromCart(cartId) {
            fetch(`/cart/remove/${cartId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Removed',
                        text: data.message,
                        confirmButtonText: 'OK'
                    });

                    // Remove the row from table
                    document.querySelector(`tr[data-id="${cartId}"]`).remove();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
@endsection
