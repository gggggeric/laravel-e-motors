<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Information Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <style>
        /* Custom CSS can be added here */
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Edit</h2>
    <form method="post" action="{{ route('admin.update', ['users' => $users]) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="adminUsername">Admin Username</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $users->name }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $users->email }}">
        </div>
        <div class="form-group">
            <label for="adminPassword">Admin Password</label>
            <input type="password" class="form-control" id="password" name="password"  value="{{ $users->password }}">
        </div>
        <div class="form-group">
            <label for="usertype">User Type</label>
            <input type="text" class="form-control" id="usertype" name="usertype" value="{{ $users->usertype }}">
        </div>
        <div class="form-group">
            <label for="userImage">User Image</label>
            <input type="file" class="form-control-file" id="userImage" name="userImage" value="{{ $users->userImage }}">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="activated" {{ $users->status == 'activated' ? 'selected' : '' }}>Activated</option>
                <option value="deactivated" {{ $users->status == 'deactivated' ? 'selected' : '' }}>Deactivated</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

          
</table>
        </form>
    </div>


    

    <!-- Bootstrap JS (Optional, if you need Bootstrap JS functionality) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
