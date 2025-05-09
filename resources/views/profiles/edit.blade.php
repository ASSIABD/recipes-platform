@extends('layouts.main')
@section('corps')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h4><i class="bi bi-person-circle"></i> Update Profile</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="text-center mb-4">
                            <img src="{{ asset('storage/' . str_replace('/storage/', '', (Auth::user()->avatar ?: 'avatars/avatarInconnue.jpg'))) }}" 
                                 alt="Profile Picture" 
                                 class="rounded-circle img-fluid mb-3" 
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="name" 
                                   name="name" 
                                   value="{{ Auth::user()->name }}" 
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" 
                                   class="form-control" 
                                   id="email" 
                                   name="email" 
                                   value="{{ Auth::user()->email }}" 
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="avatar" class="form-label">Profile Picture</label>
                            <input type="file" 
                                   class="form-control" 
                                   id="avatar" 
                                   name="avatar" 
                                   accept="image/*">
                            <small class="text-muted">Upload a square image (150x150 recommended)</small>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-danger btn-lg">
                                <i class="bi bi-save"></i> Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
