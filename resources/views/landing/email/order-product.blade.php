<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>

<body>
    <h1>Order Confirmation</h1>
    <p>Thank you for your order!</p>

    <h3>Customer Information:</h3>
    <ul>
        <li><strong>Name:</strong> {{ $name }}</li>
        <li><strong>Email:</strong> {{ $email }}</li>
        <li><strong>Phone:</strong> {{ $phone }}</li>
        <li><strong>Address:</strong> {{ $address }}</li>
        <li><strong>Message:</strong> {{ $pesan ?? '' }}</li>
    </ul>

    <h3>Order Details:</h3>

    <!-- Cart Details in Table -->
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carts as $item)
                <tr>
                    <td>{{ $item->item->name }}</td>
                    <td>Rp {{ number_format($item->item->price, 0, ',', '.') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->quantity * $item->item->price, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>We will contact you shortly to confirm your order.</p>
</body>

</html>
