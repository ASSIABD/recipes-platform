<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cooking Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
            <a class="navbar-brand" href="#"><img src="{{ asset('images/cuisine1.png') }}" alt="Logo" style="width: 30px;">  Cook & Share</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavContent" aria-controls="navbarNavContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavContent">
                <ul class="navbar-nav me-auto ms-4">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('recette.index') }}">Recipes</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('recipes.index') }}">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('auteurs.index') }}">Pages</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/chatbot') }}">IA</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('add-recipe') }}">Add Recipe</a></li>
                </ul>
                
                <!-- Right aligned items -->
                <div class="d-flex align-items-center">
                    <!-- Favorites Link with Count -->
                    @auth
                    <div class="position-relative me-2">
                        <a href="{{ route('favorites.index') }}" class="btn btn-outline-light position-relative" title="Mes Favoris">
                            <i class="bi bi-heart"></i>
                            <span id="favorites-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                {{ auth()->user()->favorites()->where('item_type', 'App\\Models\\Recipe')->count() }}
                            </span>
                        </a>
                    </div>
                    @endauth

                    <!-- Connection/Logout Button -->
                    @guest
                        <a class="btn btn-outline-light me-2" href="{{ route('login') }}">Connexion</a>
                    @else
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-outline-light me-2">Logout</button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- CONTENU -->
    <main>
        @yield('content')
    </main>

    @auth
    <script>
        // Function to update favorites count
        function updateFavoritesCount() {
            fetch('/favorites/count')
                .then(response => response.json())
                .then(data => {
                    const countBadge = document.getElementById('favorites-count');
                    if (countBadge && data.success) {
                        countBadge.textContent = data.count;
                    }
                })
                .catch(error => console.error('Error updating favorites count:', error));
        }

        // Update count when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            updateFavoritesCount();
        });

        // Listen for custom event to update favorites count
        document.addEventListener('favoritesUpdated', updateFavoritesCount);
    </script>
    @endauth
</body>
</html>