@extends('layouts.main')

@section('styles')
<style>
    .favorite-heart {
        cursor: pointer;
        font-size: 1.5rem;
        transition: color 0.3s ease;
        position: absolute !important;
        z-index: 1000;
    }
    .favorite-heart.active {
        color: #ff4444;
    }

    /* Prevent Bootstrap's default card click behavior */
    .card.no-click {
        pointer-events: none;
    }
    .card.no-click .favorite-heart {
        pointer-events: auto;
    }
    .card.no-click .card-footer {
        pointer-events: auto;
    }

    /* Custom pagination styles */
    .pagination {
        margin: 2rem 0;
    }
    .page-link {
        color: #dc3545;
        border-color: #dc3545;
    }
    .page-link:hover {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }
    .page-item.active .page-link {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }
    .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
    }
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add click event listener to heart icons
    const hearts = document.querySelectorAll('.favorite-heart');
    hearts.forEach(heart => {
        heart.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Toggle the heart icon
            this.classList.toggle('fa-solid');
            this.classList.toggle('fa-regular');
            
            // Get the recipe ID from data attribute
            const recipeId = this.dataset.recipeId;
            
            // Send AJAX request to toggle favorite
            fetch('/toggle-favorite/' + recipeId, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });

    // Add a global click handler to prevent navigation when clicking heart
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('favorite-heart')) {
            e.preventDefault();
            e.stopPropagation();
        }
    });
});
</script>
@endsection

@section('corps')
<div class="container">
    <h2 class="mb-4"><i class="bi bi-journal-richtext"></i> My Recipes</h2>
    
    @if(count($recipes) > 0)
        <div class="row">
            @foreach($recipes as $recipe)
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm no-click">
                        <div class="position-relative">
                            <img src="{{ $recipe->image }}" class="card-img-top" alt="{{ $recipe->title }}" style="height: 200px; object-fit: cover;">
                            <div class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-{{ $recipe->difficulty == 'easy' ? 'success' : ($recipe->difficulty == 'medium' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($recipe->difficulty) }}
                                </span>
                            </div>
                            <div class="position-absolute top-0 start-0 m-2" style="z-index: 1000;">
                                <i class="{{ auth()->check() && auth()->user()->favoriteRecipes()->where('recipe_id', $recipe->id)->exists() ? 'fa-solid' : 'fa-regular' }} fa-heart favorite-heart {{ auth()->check() && auth()->user()->favoriteRecipes()->where('recipe_id', $recipe->id)->exists() ? 'active' : '' }}" data-recipe-id="{{ $recipe->id }}" style="z-index: 1000;"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $recipe->title }}</h5>
                            <p class="card-text text-muted mb-2">
                                <i class="bi bi-person-circle"></i> {{ $recipe->user->name }} |
                                <i class="bi bi-folder"></i> {{ $recipe->category->name }} |
                                <i class="bi bi-clock"></i> {{ $recipe->duration }} min
                            </p>
                            <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-outline-danger">
                                <i class="bi bi-eye"></i> View Recipe
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            {{ $recipes->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="alert alert-info">
            <p class="mb-0">No recipes found. <a href="{{ route('recipes.create') }}" class="alert-link">Be the first to add one!</a></p>
        </div>
    @endif
</div>
@endsection