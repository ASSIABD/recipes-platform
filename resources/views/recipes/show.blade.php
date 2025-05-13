@extends('layouts.main')

@section('corps')
<div class="container">
    <div class="card mb-4 shadow-sm">
        <div class="row g-0">
            <div class="col-md-4">
                @if($recipe->image)
                    <img src="{{ asset('storage/' . $recipe->image) }}" class="img-fluid rounded-start h-100" style="object-fit: cover;" alt="{{ $recipe->title }}">
                @else
                    <div class="bg-light text-center py-5 h-100 d-flex flex-column justify-content-center align-items-center">
                        <i class="bi bi-camera text-muted" style="font-size: 4rem;"></i>
                        <p class="text-muted mt-2">No image available</p>
                    </div>
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h2 class="card-title mb-3">{{ $recipe->title }}</h2>
                    <div class="d-flex flex-wrap mb-3">
                        <span class="badge bg-danger me-2 mb-2"><i class="bi bi-folder"></i> {{ $recipe->category->name }}</span>
                        <span class="badge bg-{{ $recipe->difficulty == 'easy' ? 'success' : ($recipe->difficulty == 'medium' ? 'warning' : 'danger') }} me-2 mb-2">
                            {{ ucfirst($recipe->difficulty) }}
                        </span>
                        <span class="badge bg-secondary me-2 mb-2"><i class="bi bi-clock"></i> {{ $recipe->duration }} minutes</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('avatars/avatarInconnue.jpg') }}" alt="{{ $recipe->user->name }}" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                        <div>
                            <p class="text-muted mb-0">By {{ $recipe->user->name }}</p>
                            <p class="text-muted mb-0 small"><i class="bi bi-calendar"></i> {{ $recipe->created_at->format('F d, Y') }}</p>
                        </div>
                    </div>
                    <p class="card-text">{{ $recipe->description }}</p>

                    @if(Auth::check() && Auth::id() === $recipe->user_id)
                        <div class="d-flex gap-2 mt-3">
                            <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-primary">
                                <i class="bi bi-pencil me-1"></i> Edit Recipe
                            </a>
                            <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this recipe? This action cannot be undone.')">
                                    <i class="bi bi-trash me-1"></i> Delete Recipe
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Ingredients -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="bi bi-list-ul"></i> Ingredients</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach(explode("\n", $recipe->ingredients) as $ingredient)
                            @if(!empty(trim($ingredient)))
                                <li class="list-group-item">{{ $ingredient }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Steps -->
        <div class="col-md-8 mb-4">
            <div class="card h-100">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="bi bi-card-checklist"></i> Preparation Steps</h5>
                </div>
                <div class="card-body">
                    @php
                        $steps = explode("\n", $recipe->steps);
                        $stepCount = 1;
                    @endphp
                    <div class="accordion" id="stepsAccordion">
                        @foreach($steps as $index => $step)
                            @if(!empty(trim($step)))
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button" 
                                                data-bs-toggle="collapse" data-bs-target="#step{{ $index }}">
                                            Step {{ $stepCount }}: {{ Str::limit(strip_tags($step), 60) }}
                                        </button>
                                    </h2>
                                    <div id="step{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" 
                                         data-bs-parent="#stepsAccordion">
                                        <div class="accordion-body">
                                            {{ $step }}
                                        </div>
                                    </div>
                                </div>
                                @php $stepCount++; @endphp
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Review & Rating Section -->
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="bi bi-star text-danger"></i> Review & Rating</h5>
        </div>
        <div class="card-body">
            @forelse ($recipe->comments as $comment)
                <div class="mb-4 border-bottom pb-3">
                    <div class="d-flex align-items-start mb-2">
                        <img src="{{ asset($comment->user->avatar ?? 'default.jpg') }}" class="rounded-circle me-3" width="40" height="40" alt="User Avatar">
                        
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between">
                                <strong>{{ $comment->user->name }}</strong>
                                <small class="text-muted">Date: <span class="text-danger">{{ $comment->created_at->format('M d, Y') }}</span></small>
                            </div>
                            <span class="text-warning">★★★★☆</span>
                        </div>
                    </div>
                    <p class="mb-0">{{ $comment->content }}</p>
                </div>
            @empty
                <p class="text-muted">No comments yet for this recipe.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection