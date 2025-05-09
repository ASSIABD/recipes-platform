@extends('layouts.main')

@section('corps')
<div class="container">
    <h2 class="mb-4"><i class="bi bi-journal-richtext"></i> My Recipes</h2>
    
    @if(count($recipes) > 0)
        <div class="row">
            @foreach($recipes as $recipe)
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="position-relative">
                            @if($recipe->image)
                                <img src="{{ asset('storage/' . str_replace('/storage/', '', $recipe->image)) }}" class="card-img-top" alt="{{ $recipe->title }}" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="bg-light text-center py-5">
                                    <i class="bi bi-camera text-muted" style="font-size: 3rem;"></i>
                                    <p class="text-muted mt-2">No image available</p>
                                </div>
                            @endif
                            <div class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-{{ $recipe->difficulty == 'easy' ? 'success' : ($recipe->difficulty == 'medium' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($recipe->difficulty) }}
                                </span>
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
            {{ $recipes->links() }}
        </div>
    @else
        <div class="alert alert-info">
            <p class="mb-0">No recipes found. <a href="{{ route('recipes.create') }}" class="alert-link">Be the first to add one!</a></p>
        </div>
    @endif
</div>
@endsection