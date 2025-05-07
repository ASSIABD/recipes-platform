<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cooking Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-custom {
            background-color: #f44336;
        }
        .search-box {
            background-color: #f44336;
            padding: 20px;
            border-radius: 10px;
            color: white;
        }
        .search-box input,
        .search-box select {
            border-radius: 6px;
        }
        .search-box .btn {
            background-color: #444;
            color: white;
        }
        .author-card {
            text-align: center;
            margin-bottom: 20px;
        }
        .author-card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }
        .tag-card {
            width: 100%;
            margin-bottom: 15px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .tag-card img {
            width: 100%;
            height: 90px;
            object-fit: cover;
        }
        .tag-card .tag-title {
            background-color: #f44336;
            color: white;
            text-align: center;
            padding: 5px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="{{ asset('images/cuisine1.png') }}" alt="Logo" style="width: 30px;"> Cook Note</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto ms-4">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Recipes</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Pages</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
                </ul>
                <div>
                    <button class="btn btn-outline-light me-2">👤</button>
                    <button class="btn btn-light">➕</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- CONTENU -->
    <main class="py-4">
        @yield('content')
    </main>

</body>
</html>
