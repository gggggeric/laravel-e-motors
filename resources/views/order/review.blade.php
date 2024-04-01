<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Order</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Review Order</h2>
        <div class="card">
            <div class="card-header">
                Order Details
            </div>
            <div class="card-body">
                <!-- Display order details here -->
                <p><strong>Product ID:</strong> {{ $order->productID }}</p>
                <p><strong>User ID:</strong> {{ $order->userID }}</p>
                <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
                <!-- Add more order details as needed -->
            </div>
        </div>

        <!-- Add the review form here -->
        <form action="{{ route('order.submitReview', $order->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mt-4">
                <label for="commentername">Your Name</label>
                <input type="text" class="form-control" id="commentername" name="commentername">
            </div>
            <div class="form-group">
                <label for="comments">Your Comments</label>
                <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="reviewphoto">Upload Photo (Optional)</label>
                <input type="file" class="form-control-file" id="reviewphoto" name="reviewphoto">
            </div>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
