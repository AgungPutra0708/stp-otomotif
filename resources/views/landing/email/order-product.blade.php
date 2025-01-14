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

    <h3>Order Details:</h3>
    <ul>
        <li><strong>Product Name:</strong> {{ $product_name }}</li>
        <li><strong>Product Price:</strong> Rp {{ number_format($product_price, 0, ',', '.') }}</li>
        <li><strong>Name:</strong> {{ $name ?? '' }}</li>
        <li><strong>Email:</strong> {{ $email ?? '' }}</li>
        <li><strong>Phone:</strong> {{ $phone ?? '' }}</li>
        <li><strong>Address:</strong> {{ $address ?? '' }}</li>
        <li><strong>Message:</strong> {{ $pesan ?? '' }}</li>
    </ul>

    <p>We will contact you shortly to confirm your order.</p>
</body>

</html>
