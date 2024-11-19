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
                <table id="data-table" class="table table-bordered table-striped">
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


                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('index') }}',
                columns: [

                    {
                        data: 'title'
                    },
                    {
                        data: 'description'
                    },
                    {
                        data: 'user'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
        
        function confirmDelete() {
            return confirm('Are you sure you want to delete this post? This action cannot be undone.');
        }
    </script>
@endsection
