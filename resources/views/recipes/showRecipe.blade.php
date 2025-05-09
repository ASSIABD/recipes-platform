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
        <div class="row g-2 align-items-center">
            <div class="col-md-5">
                <input type="text" class="form-control" placeholder="Keywords...">
            </div>
            <div class="col-md-4">
                <select class="form-select">
                    <option selected>All Categories</option>
                    <option>Soup</option>
                    <option>Salad</option>
                </select>
            </div>
            <div class="col-md-3">
                <button class="btn w-100">Search Now</button>
            </div>
        </div>
    </div>

    

    <!-- Recipe Cards -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach ($recipes as $recipe)
        <div class="col">
            <a href="{{ route('recipes.show', $recipe->id) }}" class="text-decoration-none text-dark">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . str_replace('/storage/', '', $recipe->image)) }}" class="card-img-top" style="height: 160px; object-fit: cover;" alt="Recipe image">
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
