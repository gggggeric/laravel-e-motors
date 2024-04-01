<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Order Confirmation</h1>
    
    <p>Dear {{ $order->customer_name }},</p>
    
    <p>Your order has been successfully placed with the following details:</p>
    <p><strong>Order ID:</strong> {{ $order->id }}</p>
    <p><strong>Product:</strong> {{ $order->product_name }}</p>
    <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
    <p><strong>Total Amount:</strong> ₱{{ $order->total }}</p>
    
    <p>Thank you for shopping with us!</p>
    
    <p>Best regards,<br>E-Motors</p>
</body>
</html>
