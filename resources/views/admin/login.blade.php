<!-- resources/views/admin/login.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form method="POST" action="{{ route('login.post') }}">
    @csrf

    <div>
        <label for="adminUsername">Username</label>
        <input id="adminUsername" type="text" name="adminUsername" required autofocus>
    </div>

    <div>
        <label for="adminPassword">Password</label>
        <input id="adminPassword" type="password" name="adminPassword" required>
    </div>

    <button type="submit">Login</button>
</form>
</body>
</html>

