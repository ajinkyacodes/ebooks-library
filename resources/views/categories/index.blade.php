@extends('layouts.default')
@section('content')
    <main class="ebooks-page">
        <div class="wrapper">
            <div class="card mt-4 mb-4" style="overflow-y: auto;">
                <div class="card-header" style="font-family: sans-serif;">
                                <span>
                                    <b>All EBook Categories</b>
                                </span>
                    <p style="float:right;">
                        <a class="btn btn-sm btn-primary" href="{{route('categories.create')}}">Add New EBook Category</a>
                    </p>
                </div>
                <div class="card-body">
                    @if($categories->count()>0)
                        <table class="table text-center mb-0">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">EBooks Count</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>
                                        {{$categories->firstItem()+$loop->index}}
                                    </td>
                                    <td>
                                        {{$category->name}}
                                    </td>
                                    <td>
                                        {{$category->category}}
                                    </td>
                                    <td>
                                        {{$category->ebooks->count()}}
                                    </td>
                                    <td>
                                        <a href="{{route('categories.edit', $category->id)}}" class="btn btn-info btn-sm">
                                            Edit
                                        </a>
                                        <button class="btn btn-danger btn-sm" onclick="handleDelete({{$category->id}})">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$categories->links()}}
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form action="" method="POST" id="deleteEBookForm">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Delete EBook</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-center">Are you sure you want to delete this EBook?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go back</button>
                                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <h3>No EBook Category Available</h3>
                    @endisset
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        function handleDelete(id) {
            var form = document.getElementById("deleteEBookForm");
            form.action = '/categories/' + id;
            $('#deleteModal').modal('show');
        }
    </script>
@endsection

