@extends('layout.app')
@section('main')
    <div class="container d-flex justify-content-center align-items-center">
        <div class="row w-100 my-5">
            <div class="col-md-6 mx-auto">
                <div class="card shadow-lg rounded p-4">
                    <div class="card-body">
                        <h2 class="text-center text-primary mb-4">Register</h2>
                        <form action="{{ route('registerUser') }}" method="POST">
                            @csrf
                            <!-- Username Input -->
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" value="{{ old('name') }}" name="name" class="form-control @error('name') is-invalid @enderror" id="username" placeholder="Choose a username">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email Input -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" value="{{ old('email') }}" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter your email">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password Input -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Create a password">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Confirm Password Input -->
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" name="cpassword" class="form-control @error('cpassword') is-invalid @enderror" id="confirmPassword"
                                    placeholder="Confirm your password">
                                    @error('cpassword')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>

                            <!-- Register Button -->
                            <button type="submit" class="btn btn-primary w-100">Register</button>
                        </form>
                        <div class="d-flex justify-content-between mt-3">
                            <p class="mb-0">Already have an account? <a href="{{ route('login') }}"
                                    class="text-decoration-none text-primary">Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
