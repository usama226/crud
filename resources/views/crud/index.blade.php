@extends('layout.app')
@section('main')
<div class="container mt-5">
    <!-- Table to Display Entries -->
    <div class="table-container">
        <h3 class="text-center text-primary mb-4">Posts List</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($posts->isNotEmpty())
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->description }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td> {{ \Carbon\Carbon::parse($post->created_at)->format('d M, Y') }}</td>
                        <td>
                            <a class="btn btn-outline-primary" href="">View</a>
                            <a class="btn btn-primary" href="">update</a>
                            <a class="btn btn-danger" href="">Delete</a>

                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5"> No record Found. </td>
                    </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
