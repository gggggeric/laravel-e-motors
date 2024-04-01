<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Order</h2>

        <form action="{{ route('orderManagement.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="productID">Product ID:</label>
                <input type="text" class="form-control" id="productID" name="productID" value="{{ $order->productID }}" readonly>
            </div>

            <div class="form-group">
                <label for="userID">User ID:</label>
                <input type="text" class="form-control" id="userID" name="userID" value="{{ $order->userID }}" readonly>
            </div>

            <div class="form-group">
                <label for="orderStatus">Order Status:</label>
                <select class="form-control" id="orderStatus" name="orderStatus">
                    <option value="Paid" {{ $order->orderStatus == 'Paid' ? 'selected' : '' }}>Paid</option>
                    <option value="Not Paid" {{ $order->orderStatus == 'Not Paid' ? 'selected' : '' }}>Not Paid</option>
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $order->quantity }}">
            </div>

            <div class="form-group">
                <label for="total">Total:</label>
                <input type="text" class="form-control" id="total" name="total" value="{{ $order->total }}">
            </div>

            <div class="form-group">
                <label for="shippingAddress">Shipping Address:</label>
                <input type="text" class="form-control" id="shippingAddress" name="shippingAddress" value="{{ $order->shippingAddress }}">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ $order->email }}">
            </div>

            <div class="form-group">
                <label for="modeOfPayment">Mode of Payment:</label>
                <input type="text" class="form-control" id="modeOfPayment" name="modeOfPayment" value="{{ $order->modeOfPayment }}">
            </div>

            <button type="submit" class="btn btn-primary">Update Order</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
