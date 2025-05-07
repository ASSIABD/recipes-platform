@extends('layouts.main')

@section('corps')
<div class="container">
    <nav class="breadcrumb mb-2">
        <span class="breadcrumb-item">Home</span>
        <span class="breadcrumb-item active">Authors</span>
    </nav> 
    <h3 class="mb-4">Authors</h3>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @for ($i = 0; $i < 12; $i++)
            <div class="col">
                <div class="card author-card h-100 p-3 border-0 shadow-sm">
                    <img src="https://i.pravatar.cc/150?img={{ $i+1 }}" alt="Author photo" class="mx-auto d-block mb-2">
                    <div class="card-body p-0">
                        <h6 class="card-title mb-1">Nom Auteur {{ $i + 1 }}</h6>
                        <p class="card-text text-muted">(46 Recipes)</p>
                    </div>
                </div>
            </div>
        @endfor
    </div>
    <div class="text-center mt-4">
        <button class="btn btn-dark">Load More...</button>
    </div>
</div>
@endsection
