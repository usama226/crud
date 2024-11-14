@extends('layout.app')
@include('message')
@section('main')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row w-100">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-lg rounded p-4">
                <div class="card-body">

                    <h2 class="text-center text-primary mb-4">Login</h2>
                    <form action="{{ route('loginUser') }}" method="POST">
                        @csrf
                        <!-- Username Input -->
                        <div class="mb-3">
                            <label for="Email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="username" placeholder="Enter your Email" >
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @if (session('error'))
                            <span class="text-danger">{{ session('error') }}</span>

                            @endif
                        </div>

                        <!-- Password Input -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" >
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <!-- Login Button -->
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                    <div class="d-flex justify-content-between mt-3">
                        <a href="#" class="text-decoration-none text-primary">Forgot Password?</a>
                        <p class="mb-0">Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none text-primary">Sign Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
