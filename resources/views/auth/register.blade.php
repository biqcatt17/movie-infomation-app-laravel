@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card auth-card bg-dark text-white">
                <div class="card-header text-center">
                    <h3 class="mb-0">{{ __('Create Account') }}</h3>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group mb-4">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-primary">
                                    <i class="fas fa-user text-primary"></i>
                                </span>
                                <input id="name" type="text" class="form-control custom-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                            @error('name')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-primary">
                                    <i class="fas fa-envelope text-primary"></i>
                                </span>
                                <input id="email" type="email" class="form-control custom-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                            @error('email')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-primary">
                                    <i class="fas fa-lock text-primary"></i>
                                </span>
                                <input id="password" type="password" class="form-control custom-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            </div>
                            @error('password')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-primary">
                                    <i class="fas fa-lock text-primary"></i>
                                </span>
                                <input id="password-confirm" type="password" class="form-control custom-input" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary w-100 mb-3">
                                <i class="fas fa-user-plus me-2"></i>{{ __('Register') }}
                            </button>

                            <div class="text-center">
                                <a class="text-primary text-decoration-none" href="{{ route('login') }}">
                                    {{ __('Already have an account? Login') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* The same style block as in login.blade.php */
.auth-card {
    margin-top: 30px;
    border: none;
    border-radius: 15px;
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(10px);
    transition: transform 0.3s ease;
}

.auth-card:hover {
    transform: translateY(-5px);
}

.card-header {
    background: linear-gradient(45deg, #1a1a1a, #2d2d2d);
    border-bottom: 2px solid #375a7f;
    border-radius: 15px 15px 0 0 !important;
    padding: 1.5rem;
}

.custom-input {
    background-color: #2d2d2d !important;
    border: 1px solid #375a7f;
    color: white !important;
    padding: 10px 15px;
    border-radius: 0 8px 8px 0 !important;
}

.custom-input:focus {
    box-shadow: none;
    border-color: #4a7ab3;
}

.input-group-text {
    border: 1px solid #375a7f;
    border-right: none;
    border-radius: 8px 0 0 8px !important;
}

.btn-primary {
    background: linear-gradient(45deg, #375a7f, #4a7ab3);
    border: none;
    border-radius: 8px;
    padding: 12px;
    font-weight: 500;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(45deg, #4a7ab3, #375a7f);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(55, 90, 127, 0.3);
}
</style>
@endsection
