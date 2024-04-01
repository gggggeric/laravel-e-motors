<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Orders</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
</head>
<body>
    <div class="container">
        <h1>Confirm Orders</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Input fields for Order ID and Order Status -->
        <form method="post" action="{{ route('order.updateStatus') }}" id="updateOrderForm" class="mb-3">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label for="orderId" class="form-label">Order ID</label>
                    <input type="text" class="form-control" id="orderId" name="orderId" required>
                </div>
                <div class="col-md-4">
                    <label for="orderStatus" class="form-label">Order Status</label>
                    <select class="form-select" id="orderStatus" name="orderStatus" required>
                        <option value="Not Paid">Not Paid</option>
                        <option value="Paid">Paid</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Save Order Status</button>
                </div>
            </div>
        </form>

        <!-- Display orders associated with the product sold by the authenticated seller -->
        <table id="ordersTable" class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Status</th>
                    <th>User Name</th>
                    <th>User Address</th>
                    <th>Item Ordered</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->orderStatus }}</td>
                    <td>{{ $order->user ? $order->user->email : 'N/A' }}</td>
                    <td>{{ $order->shippingAddress }}</td>
                    <td>{{ $order->product ? $order->product->product_name : 'N/A' }}</td>
                    <!-- Add more columns as needed -->
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#ordersTable').DataTable();
        });

        // Submit form when Save button is clicked
        $('#updateOrderForm').submit(function (event) {
            event.preventDefault(); // Prevent default form submission
            var formData = $(this).serialize(); // Serialize form data
            $.post('{{ route("order.updateStatus") }}', formData)
                .done(function (response) {
                    // Reload the page or update the table as needed
                    location.reload();
                })
                .fail(function (error) {
                    // Handle errors, display error messages, etc.
                    console.error(error);
                });
        });
    </script>
</body>
</html>
