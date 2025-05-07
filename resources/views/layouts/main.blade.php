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
            <div class="col-md-4">
                <!-- Search Box -->
                <div class="search-box mb-4">
                    <h5><i class="bi bi-search"></i> Rechercher</h5>
                    <div class="input-group mb-3"> <span class="input-group-text"> <i class="bi bi-question-circle"></i> </span> <input type="text" class="form-control" placeholder="Keywords..."> </div>
                    <div class="input-group mb-3"> <span class="input-group-text"> <i class="bi bi-folder"></i> </span> 
                        <select class="form-select"> 
                            <option>All Categories</option> 
                            <option>Fish</option> 
                            <option>Salads</option> 
                        </select> 
                    </div>
                    <button class="btn w-100">Search Now</button>
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
        </div>
    </div>

</body>
</html>
