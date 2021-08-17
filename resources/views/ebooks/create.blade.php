@extends('layouts.default')
@section('content')
    <main>
        <div class="wrapper">
            <div class="col-md-12 mt-4 mb-4">
                <div class="card" style="font-family: sans-serif;">
                    <div class="card-header">
                                <span>
                                    <b>{{isset($ebook)? 'Update ebook' : 'Add New ebook'}}</b>
                                </span>
                        <p style="float:right;">
                            <a class="btn btn-sm btn-secondary" href="{{route('ebooks.index')}}">Back to ebooks</a>
                        </p>
                    </div>
                    <div class="card-body">
                        <form action="{{isset($ebook) ? route('ebooks.update', $ebook->id) : route('ebooks.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            @if(isset($ebook))
                                @method('PUT')
                            @endif

                            <div class="form-group">
                                <label for="ebook_file">Ebook File</label>
                                @if(isset($ebook->ebook_file))
                                    <input type="hidden" name="ebook_file_old" value="{{isset($ebook)? $ebook->ebook_file : old('ebook_file_old')}}">
                                @endif
                                <input type="file" class="form-control" name="ebook_file" value="{{isset($ebook)? $ebook->ebook_file : old('ebook_file')}}">
                                @error('ebook_file')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="featured_image">Featured Image</label>
                                @if(isset($ebook->featured_image))
                                    <input type="hidden" name="featured_old_image" value="{{isset($ebook)? $ebook->featured_image : old('featured_old_image')}}">
                                    <figure>
                                        <img id="showUploadImage" src="{{asset($ebook->featured_image)}}" class="mb-4" alt="{{$ebook->title}}" style="max-width: 300px; height: auto; margin: 0 auto;">
                                    </figure>
                                @endif
                                <input id="UploadImageFile" type="file" class="form-control" name="featured_image" value="{{isset($ebook)? $ebook->featured_image : old('featured_image')}}">
                                @error('featured_image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" class="form-control" name="title" maxlength="100" value="{{isset($ebook)? $ebook->title : old('title')}}">
                                @error('title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="author">Author</label>
                                <input type="text" id="author" class="form-control" name="author" maxlength="100" value="{{isset($ebook)? $ebook->author : old('author')}}" >
                                @error('author')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" class="form-control" name="description" style="min-height: 200px;">{{isset($ebook)? $ebook->description : old('description')}}</textarea>
                                @error('description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="category_id">Select ebook Category</label>
                                @if($categories->count() > 0)
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">No Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"
                                                    @if(isset($ebook))
                                                    @if($category->id == $ebook->category_id)
                                                    selected
                                                @endif
                                                @endif
                                            >
                                                {{$category->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <a href="#FIXME">
                                        <p class="text-warning">Please Add ebook Category to proceed. (Click Here)</p>
                                    </a>
                                @endif
                                @error('category_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success">{{isset($ebook)? 'Update ebook' : 'Add ebook'}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#description').summernote();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#UploadImageFile').change(function (e){
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showUploadImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });

            //For Tag Select Plugin
            $('.tag-selector').select2();
        });
    </script>
@endsection
