<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: -webkit-linear-gradient(to right, #FDFCFB, #cbb8a9);
            background: linear-gradient(to right,#FDFCFB, #cbb8a9);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        header {
            text-align: center;
            margin-bottom: 20px;
        }
        h1 {
            font-size: 2.5rem;
            color: #333;
        }
        nav {
            margin-top: 20px;
        }
        .nav-links a {
            text-decoration: none;
            color: white;
            background-color: #ff7200;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            margin: 0 10px;
            transition: background-color 0.3s;
        }
        .nav-links a:hover {
            background-color:#ff7200;
        }
        footer {
            position: fixed;
            bottom: 10px;
            font-size: 0.9rem;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">LMS    </h2>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="#">HOME</a></li>
                    <li><a href="#">ABOUT</a></li>
                    <li><a href="#">SERVICE</a></li>
                    <li><a href="#">DESIGN</a></li>
                    <li><a href="#">CONTACT</a></li>
                </ul>
            </div>
            <div class="search">
                <input class="srch" type="search" name="" placeholder="Type To text">
                <a href="#"> <button class="btn">Search</button></a>
            </div>
            <div class="content">
    
            <h1>Student Achievments &<span> Internship</span> terminal</h1>
    <p class="par">
        Keep a record of your achievments, internships and more.
        Register now if you have not or login.
    </p>

            

    <nav>
        <div class="nav-links">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    
</body>
</html>
