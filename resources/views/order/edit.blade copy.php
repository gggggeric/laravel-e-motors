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
    <!-- Custom CSS -->
    <style>
        /* Custom styles for DataTable */
        #ordersTable_wrapper {
            margin-top: 20px;
        }

        /* Customize select dropdown */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #495057;
            line-height: 1.5;
        }

        .select2-container .select2-selection--single {
            height: calc(2.25rem + 2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Confirm Orders</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Display orders associated with the product sold by the authenticated seller -->
        <table id="ordersTable" class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Status</th>
                    <th>User Name</th>
                    <th>User Address</th>
                    <th>Item Ordered</th>
                    <th>Action</th> <!-- New column for update action -->
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
                    <td>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" onchange="updateOrderStatus(this, '{{ $order->id }}')">
                            <option value="Not Paid" {{ $order->orderStatus == 'Not Paid' ? 'selected' : '' }}>Not Paid</option>
                            <option value="Paid" {{ $order->orderStatus == 'Paid' ? 'selected' : '' }}>Paid</option>
                        </select>
                    </td>
                    <!-- Add more columns as needed -->
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Button to save order status -->
<form method="post" action="{{ route('order.updateStatus') }}" id="updateOrderStatusForm">
    @csrf
    <button type="submit" class="btn btn-primary">Save Order Status</button>
</form>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#ordersTable').DataTable();
        });

        // Function to update order status
        function updateOrderStatus(selectElement, orderId) {
            var newStatus = selectElement.value;
            // Set the hidden input values with the updated data
            $('#orderId').val(orderId);
            $('#orderStatus').val(newStatus);
        }
    </script>
</body>
</html>
