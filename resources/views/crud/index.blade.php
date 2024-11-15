@extends('layout.app')
@section('main')
<div class="container mt-5">
    <!-- Table to Display Entries -->
    <div class="table-container">
        @include('message')
        <h3 class="text-center text-primary mb-4">Posts List</h3>
        <div class="d-flex justify-content-between">
        <a class="btn btn-primary mb-3" href="{{ route('createPost') }}">Create Post</a>
        <a class="btn btn-danger mb-3" href="{{ route('logout') }}">logout</a>
    </div>
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
                        <td>{{ Str::words($post->description,5)  }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td> {{ \Carbon\Carbon::parse($post->created_at)->format('d M, Y') }}</td>
                        <td>
                            <a class="btn btn-outline-primary" href="{{ route('viewPost',$post->id) }}">View</a>
                            <a class="btn btn-primary" href="{{ route('editPost',$post->id) }}">update</a>
                            <form class="d-inline-block" action="{{ route('deletePost', $post->id) }}" method="POST" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            
                            <script>
                                function confirmDelete() {
                                    return confirm('Are you sure you want to delete this post? This action cannot be undone.');
                                }
                            </script>                          

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
            {{ $posts->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
