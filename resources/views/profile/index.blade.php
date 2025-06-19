<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card profile-card bg-dark text-white">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card-body p-4">
                    <div class="text-center position-relative mb-5">
                        <div class="profile-picture-container">
                            <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-avatar.png') }}" 
                                 class="profile-picture" 
                                 alt="Profile Picture">
                            <button class="btn btn-primary btn-sm edit-profile-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editProfileModal">
                                <i class="fas fa-edit"></i> Edit Profile
                            </button>
                        </div>
                        <h3 class="mt-3 mb-0">{{ $user->name }}</h3>
                        <p class="text-muted">Member since {{ $user->created_at->format('F Y') }}</p>
                    </div>

                    <div class="profile-info">
                        <div class="info-group">
                            <h5 class="info-label"><i class="fas fa-envelope"></i> Email</h5>
                            <p class="info-value">{{ $user->email }}</p>
                        </div>

                        <div class="info-group">
                            <h5 class="info-label"><i class="fas fa-calendar"></i> Age</h5>
                            <p class="info-value">{{ $user->age ?? 'Not set' }}</p>
                        </div>

                        <div class="info-group">
                            <h5 class="info-label"><i class="fas fa-info-circle"></i> Bio</h5>
                            <p class="info-value">{{ $user->bio ?? 'No bio added yet' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="modal-header border-bottom border-secondary">
                    <h5 class="modal-title">Edit Profile</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                
                <div class="modal-body">
                    <div class="mb-4">
                        <label class="form-label"><i class="fas fa-camera"></i> Profile Picture</label>
                        <input type="file" class="form-control custom-file-input" name="profile_picture" accept="image/*">
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label"><i class="fas fa-user"></i> Name</label>
                        <input type="text" class="form-control custom-input" name="name" value="{{ $user->name }}">
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label"><i class="fas fa-calendar"></i> Birth Date</label>
                        <input type="date" class="form-control custom-input" name="birth_date" value="{{ $user->birth_date }}">
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label"><i class="fas fa-pen"></i> Bio</label>
                        <textarea class="form-control custom-input" name="bio" rows="4">{{ $user->bio }}</textarea>
                    </div>
                </div>
                
                <div class="modal-footer border-top border-secondary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.profile-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(0,0,0,0.3);
}

.profile-picture-container {
    position: relative;
    display: inline-block;
}

.profile-picture {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 50%;
    border: 4px solid #375a7f;
    box-shadow: 0 0 15px rgba(55, 90, 127, 0.3);
    transition: transform 0.3s ease;
}

.profile-picture:hover {
    transform: scale(1.05);
}

.edit-profile-btn {
    position: absolute;
    bottom: 0;
    right: 0;
    border-radius: 20px;
    padding: 8px 15px;
    font-size: 0.9rem;
    background-color: #375a7f;
    border: none;
    transition: all 0.3s ease;
}

.edit-profile-btn:hover {
    background-color: #2a4562;
    transform: translateY(-2px);
}

.info-group {
    background-color: rgba(55, 90, 127, 0.1);
    border-radius: 10px;
    padding: 15px 20px;
    margin-bottom: 15px;
}

.info-label {
    color: #375a7f;
    font-size: 1rem;
    margin-bottom: 5px;
}

.info-value {
    margin-bottom: 0;
    font-size: 1.1rem;
}

.custom-input {
    background-color: #2d2d2d;
    border: 1px solid #375a7f;
    color: white;
    border-radius: 8px;
    padding: 10px 15px;
}

.custom-input:focus {
    background-color: #2d2d2d;
    border-color: #375a7f;
    color: white;
    box-shadow: 0 0 0 0.25rem rgba(55, 90, 127, 0.25);
}

.custom-file-input {
    background-color: #2d2d2d;
    border-color: #375a7f;
    color: white;
}

.modal-content {
    border-radius: 15px;
}

.modal-header, .modal-footer {
    border-color: #375a7f !important;
}

.btn-primary {
    background-color: #375a7f;
    border: none;
}

.btn-primary:hover {
    background-color: #2a4562;
}
</style>
@endsection
</body>
</html>