@extends('layouts.navBare')

@section('content')
<div class="container mt-4">

    <!-- Breadcrumb -->
    <nav class="breadcrumb mb-3">
        <span class="breadcrumb-item">Home</span>
        <span class="breadcrumb-item active">Recipes - Grid Layout</span>
    </nav>

    <!-- Search Box -->
    <div class="search-box mb-5">
        <form action="{{ route('recette.index') }}" method="GET" class="mb-4">
            <div class="row g-2 align-items-center">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control" placeholder="Search recipes..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select name="category" class="form-select">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>
            </div>
        </form>
    </div>

    

    <!-- Recipe Cards -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach ($recipes as $recipe)
        <div class="col">
            <a href="{{ route('recipes.show', $recipe->id) }}" class="text-decoration-none text-dark">
                <div class="card h-100 shadow-sm">
                    <img src="{{ $recipe->image ? asset($recipe->image) : asset('images/placeholder.jpg') }}" class="card-img-top" style="height: 160px; object-fit: cover;" alt="{{ $recipe->title }}">
                    <div class="card-body">
                        <h6 class="card-title">{{ $recipe->title }}</h6>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-warning">★★★★☆</span>
                            <small class="text-muted">{{ $recipe->duration ?? 'N/A' }} min</small>
                        </div>
                        <p class="mb-0 mt-2">
                            <i class="bi bi-heart toggle-heart text-danger" style="cursor: pointer;"></i>
                            <span class="text-muted">Save</span>
                        </p>
                    </div>
                    <hr class="my-2">
                    <div class="card-footer bg-white border-0 d-flex align-items-center justify-content-center">
                        <img src="{{ asset($recipe->user->avatar ?? 'default.jpg') }}" class="rounded-circle me-2" width="30" height="30" alt="Author">
                        <small class="text-muted">{{ $recipe->user->name }}</small>
                    </div>
                </div>
            </a>
        </div>
        
        @endforeach
    </div>

    <div class="text-center mt-4">
        <button class="btn btn-dark rounded-pill">Show All Recipes</button>
    </div>
</div>

<!-- Script pour changer l'icône -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.toggle-heart').forEach(function(icon) {
            icon.addEventListener('click', function () {
                this.classList.toggle('bi-heart');
                this.classList.toggle('bi-heart-fill');
            });
        });
    });
</script>
@endsection
