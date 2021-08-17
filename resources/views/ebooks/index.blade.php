@extends('layouts.default')
@section('content')
    <main class="ebooks-page">
        <div class="wrapper">
            <h2>Hi.. {{ Auth::user()->name }}</h2>
            <div class="col-md-12 mb-4">
                <div class="card" style="overflow-y: auto;">
                    <div class="card-header">
                                <span>
                                    <b>All Ebooks</b>
                                </span>
                        <p style="float:right;">
                            <a class="btn btn-sm btn-primary" href="{{route('ebooks.create')}}">Add New ebook</a>
                        </p>
                    </div>
                    <div class="card-body">
                        @if($ebooks->count()>0)
                            <table class="table text-center">
                                <thead>
                                <tr>
                                    <th scope="col">Featured Image</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Category</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ebooks as $ebook)
                                    <tr>
                                        <td>
                                            <a href="{{$ebook->ebook_file}}" title="{{$ebook->title}}" target="_blank">
                                                <img src="{{asset($ebook->featured_image)}}" alt="{{$ebook->title}}" height="auto" class="m-auto" style="width:100%; max-width: 200px;">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('ebooks.show',$ebook->id)}}" title="{{$ebook->title}}" class="text-dark">
                                                <p>{{$ebook->title}}</p>
                                            </a>
                                        </td>
                                        <td>
                                            {{$ebook->author}}
                                        </td>
                                        <td>
                                            <div style="width: 200px;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;">{!! $ebook->description !!}</div>
                                        </td>
                                        <td>
                                            <a href="#FIXME" title="Category" class="text-dark">
                                                @if(!empty(\App\Models\Category::where('id',$ebook->category_id)->first()))
                                                    {{\App\Models\Category::where('id',$ebook->category_id)->first()->name}}
                                                @else
                                                    <span>N/A</span>
                                                @endif
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('ebooks.show', $ebook->id)}}" class="btn btn-primary btn-sm">
                                                View
                                            </a>
                                            <a href="{{route('ebooks.edit', $ebook->id)}}" class="btn btn-info btn-sm">
                                                Edit
                                            </a>
                                            <button class="btn btn-danger btn-sm" onclick="handleDelete({{$ebook->id}})">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form action="" method="POST" id="deleteebookForm">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Delete ebook</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="text-center">Are you sure you want to permanently delete this ebook?</p>
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
                            <h3>No Ebooks Available</h3>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        function handleDelete(id) {
            var form = document.getElementById("deleteebookForm");
            form.action = '/ebooks/' + id;
            $('#deleteModal').modal('show');
        }
    </script>
@endsection
