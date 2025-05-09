@extends('layouts.main')
@section('corps')
<div class="container">
    <nav class="breadcrumb mb-2">
        <span class="breadcrumb-item">Home</span>
        <span class="breadcrumb-item active">Authors</span>
    </nav> 
    <h3 class="mb-4">Authors</h3>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach ($users as $user)
            <div class="col">
                <div class="card author-card h-100 p-3 border-0 shadow-sm">
                    <img src="{{ asset($user->avatar ? 'storage/' . str_replace('/storage/', '', $user->avatar) : 'avatars/avatarInconnue.jpg') }}" alt="{{ $user->name }}" class="mx-auto d-block mb-2 rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                    <div class="card-body p-0">
                        <h6 class="card-title mb-1">{{ $user->name }}</h6>
                        <p class="card-text text-muted">({{ $user->recipes_count }} Recipes)</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="text-center mt-4">
        <button class="btn btn-dark rounded-pill">Load More...</button>
    </div>
</div>
@endsection
