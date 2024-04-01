<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        /* Add some spacing between table rows */
        .table tbody tr:not(:last-child) {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <h2 class="mb-4">Product Registration</h2>
        <form action="{{ route('seller.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('post')
    <div class="form-group">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" class="form-control" id="product_name">
    </div>
    <div class="form-group">
        <label for="amount">Amount:</label>
        <input type="number" name="amount" class="form-control" id="amount">
    </div>
    <div class="form-group">
        <label for="product_type">Product Type:</label>
        <input type="text" name="product_type" class="form-control" id="product_type">
    </div>
    <div class="form-group">
        <label for="product_image">Product Image:</label>
        <input type="file" name="product_image" class="form-control" id="product_image">
    </div>
    <div class="form-group">
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" class="form-control" id="quantity">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


        <table class="table" id="productTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Product Name</th>
                    <th>Amount</th>
                    <th>Product Type</th>
                    <th>Product Image</th>
                    <th>Quantity</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->user_id }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->amount }}</td>
                        <td>{{ $product->product_type }}</td>
                        <td>
                        <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->product_name }}" style="max-width: 100px;">
                        </td>
                        <td>{{ $product->quantity }}</td>
                        <td>
                            <form method="get" action="{{ route('seller.editProduct', ['product' => $product]) }}">
                                @csrf
                                <button type="submit" class="btn btn-link">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                    </svg>
                                    EDIT
                                </button>
                            </form>
                        </td>
                        <td>
                            <form method="post" action="{{ route('seller.destroy', ['product' => $product]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                    </svg>
                                    DELETE
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        // Initialize DataTable
        $(document).ready( function () {
            $('#productTable').DataTable();
        });
    </script>
</body>
</html>
