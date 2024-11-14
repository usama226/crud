@extends('layout.app')
@section('main')
<style>

    /* Custom form style */
    .form-container {
        background-color: rgba(255, 255, 255, 0.9); /* Light translucent background for the form */
        border-radius: 15px;
        padding: 2rem;
        margin-top: 50px;
    }

    .btn {
        min-width: 120px;
    }
</style>
<div class="container mt-5">
    <div class="form-container">
        <h2 class="text-center text-primary mb-4">Create New Item</h2>
        <!-- Form Start -->
        <form action="{{ route('storePost') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid  @enderror" id="title" placeholder="Enter Title">
                @error('title')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid  @enderror" name="description" id="description" rows="4" placeholder="Enter Description"></textarea>
                @error('description')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="mb-3 d-flex justify-content-between">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Save</button>
                <button type="reset" class="btn btn-secondary"><i class="bi bi-arrow-clockwise"></i> Reset</button>
            </div>
        </form>
    </div>
</div>

@endsection
