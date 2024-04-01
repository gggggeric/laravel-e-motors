<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Create Order</h2>
        <form action="{{ route('order.store') }}" method="POST">
            @csrf
            @method('post')
            
            <!-- Hidden Product ID -->
            <input type="hidden" name="productID" value="{{ $productID }}">
            
            <!-- Hidden User ID -->
            <input type="hidden" name="userID" value="{{ auth()->id() }}">
            
            <!-- Hidden Order Status -->
            <input type="hidden" name="orderStatus" value="Not Paid">
            
            <!-- Quantity -->
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="text" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}">
            </div>
            
            <!-- Total (Hidden) -->
            <input type="hidden" name="total" value="{{ old('total') }}">
            
            <!-- Shipping Address -->
            <div class="form-group">
                <label for="shippingAddress">Shipping Address</label>
                <input type="text" class="form-control" id="shippingAddress" name="shippingAddress" value="{{ old('shippingAddress') }}">
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
            </div>
            
            <!-- Mode of Payment -->
            <div class="form-group">
                <label for="modeOfPayment">Mode of Payment</label>
                <select class="form-control" id="modeOfPayment" name="modeOfPayment">
                    <option value="Cash">Cash on Delivery</option>
                    <option value="Gcash">Gcash</option>
                    <!-- Add more options as needed -->
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Create Order</button>
        </form>
    </div>

    <!-- Bootstrap JS (Optional, if you need Bootstrap JS functionality) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
