@include('layouts.navBare')
@section('content')
    <!-- MAIN -->
    <div class="container mt-5">
        <div class="row">
            <!-- MAIN CONTENT -->
            <div class="col-md-8">
                @yield('corps') <!-- Zone vide adaptable -->
            </div>

            <!-- SIDEBAR -->
            @if(!request()->is('recipes/create'))
            <div class="col-md-4">
                <!-- Search Box -->
                <div class="search-box mb-4" style="background-color: #EA5748; padding: 20px; border-radius: 10px; color: white;">
                    <h5><i class="bi bi-search"></i> Rechercher</h5>
                    <form method="GET" action="{{ route('recette.index') }}">
                        <div class="input-group mb-3">
                            <span class="input-group-text" style="background-color: #f0f0f0; border-color: #ced4da;">
                                <i class="bi bi-question-circle"></i>
                            </span>
                            <input type="text" 
                                   name="keywords" 
                                   class="form-control" 
                                   placeholder="Keywords..." 
                                   value="{{ request('keywords') }}">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" style="background-color: #f0f0f0; border-color: #ced4da;">
                                <i class="bi bi-folder"></i>
                            </span>
                            <select name="category" class="form-select">
                                <option value="">All Categories</option>
                                @if(isset($searchableCategories))
                                    @foreach($searchableCategories as $category)
                                        <option value="{{ $category->id }}" 
                                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <button type="submit" class="btn w-100" style="background-color: #444; color: white;">
                            <i class="bi bi-search"></i> Search Now
                        </button>
                    </form>
                </div>

                <!-- Tags with images -->
                <div class="row">
                    <div class="col-6">
                        <div class="tag-card">
                            <img src="{{ asset('images/tagFish.jpg') }}" alt="Fish">
                            <div class="tag-title">Fish</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="tag-card">
                            <img src="{{ asset('images/tagCoktail.jpg') }}" alt="Cocktails">
                            <div class="tag-title">Cocktails</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="tag-card">
                            <img src="{{ asset('images/tagEgg.jpg') }}" alt="Eggs">
                            <div class="tag-title">Eggs</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="tag-card">
                            <img src="{{ asset('images/tagSalade.jpg') }}" alt="Salads">
                            <div class="tag-title">Salads</div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

</body>
</html>
