@extends('layout.app')
@section('main')
<div class="container mt-5">
    <!-- Table to Display Entries -->
    <div class="table-container col-6 m-auto">
        @include('message')
        <h3 class="text-center text-primary mb-4">Compelet Details</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
               <tbody>
                <tr>
                    <th style="width: 20%">Post Title:</th>
                    <td>{{ $post->title }}</td>
                </tr>
                <tr>
                    <th style="width: 20%">created_by:</th>
                    <td>{{ $post->user->name }}</td>
                </tr>
                <tr>
                    <th style="width: 20%">created_at:</th>
                    <td>{{ \carbon\carbon::parse($post->created_at)->format('d M,Y') }}</td>
                </tr>
                <tr>
                    <th style="width: 20%">Description:</th>
                </tr>
                    <td colspan="2">{{ $post->description }}</td>
            
               </tbody>
            </table>
            <a href="{{ route('index') }}" class="btn btn-secondary">Back</a>
            
            
        </div>
    </div>
</div>
@endsection
