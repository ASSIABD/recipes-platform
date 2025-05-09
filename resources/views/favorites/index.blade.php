@extends('layouts.navBare')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center mb-4">Mes Recettes Préférées</h1>
            
            @if(isset($favorites) && count($favorites) > 0)
                <div class="row">
                    @foreach($favorites as $recipe)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="{{ asset('storage/' . $recipe->image) }}" class="card-img-top" alt="{{ $recipe->title }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $recipe->title }}</h5>
                                    <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>
                                    <a href="{{ route('recette.show', $recipe->id) }}" class="btn btn-outline-danger">Voir la recette</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center">
                    <p class="lead">Vous n'avez pas encore ajouté de recettes à vos favoris.</p>
                    <a href="{{ route('recette.index') }}" class="btn btn-outline-danger">Explorer les recettes</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
