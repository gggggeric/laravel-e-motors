<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
        }
        body {
            margin: 0;
            font-family: 'Nunito', sans-serif;
            background-image: url('https://source.unsplash.com/featured/?car,motor,parts');
            background-size: auto 75%; /* Auto width, 100% height */
            background-position: center; /* Center the image horizontally */
            background-repeat: repeat-x; /* Repeat vertically */
            display: flex;
            flex-direction: column; /* Align items vertically */
            align-items: flex-start; /* Align items to the top */
            min-height: 100vh;
            padding-left: 20px; /* Add padding to give space */
            padding-top: 20px; /* Add padding to give space */
            position: relative; /* Relative positioning for absolute children */
        }
        h1 {
            color: #fff;
            margin-bottom: 30px;
        }
        .link-container {
            margin-left: -20px; /* Compensate for the body padding */
            position: absolute; /* Position the links relative to the body */
            top: 50px; /* Adjust the top position */
        }
        .link {
            font-size: 18px;
            color: #007bff;
            text-decoration: none;
            margin: 10px;
            transition: all 0.3s ease;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 10px 20px;
            border-radius: 5px;
        }
        .link:hover {
            color: #0056b3;
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Welcome to Laravel</h1>
    <div class="link-container">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/home') }}" class="link">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="link">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="link">Register</a>
                @endif
            @endauth
        @endif
    </div>
</body>
</html>
