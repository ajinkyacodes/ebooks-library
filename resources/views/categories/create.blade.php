@extends('layouts.default')
@section('content')
    <div class="container mb-4 mt-4" style="font-family: sans-serif;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                                <span>
                                    <b>{{isset($category)? 'Update EBook Category' : 'Add New EBook Category'}}</b>
                                </span>
                        <p style="float:right;">
                            <a class="btn btn-sm btn-secondary" href="{{route('categories.index')}}">Back to EBook Categories</a>
                        </p>
                    </div>
                    <div class="card-body">
                        <form action="{{isset($category) ? route('categories.update', $category->id) : route('categories.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            @if(isset($category))
                                @method('PUT')
                            @endif

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" name="name" value="{{isset($category)? $category->name : old('name')}}">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success">{{isset($category)? 'Update EBook category' : 'Add EBook category'}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
