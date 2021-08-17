@extends('layouts.default')
@section('content')
<main class="ebook_details_page">
    <div class="wrapper">
        <div class="col-md-12 mt-4 mb-4">
            <div class="card" style="overflow-y: auto; font-family: sans-serif;">
                <div class="card-header">
                        <span>
                            <b>Ebook Details</b>
                        </span>
                    <p style="float:right;">
                        <a class="btn btn-sm btn-secondary" href="{{route('ebooks.index')}}">Back to ebooks</a>
                    </p>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <figure style="background-color: #000;">
                            <img src="{{ asset("$ebook->featured_image") }}" alt="{{ $ebook->title }}" style="width: auto; height: 500px; object-fit: cover; margin: 0 auto;">
                        </figure>
                    </div>
                    <div class="form-group">
                        <h2 class="pl-0">{{ $ebook->title }}</h2>
                    </div>
                    <div class="form-group">
                        <strong>Created at:</strong>
                        {{ date('d M Y, h:i A', strtotime($ebook->created_at)) }}
                    </div>
                    <div class="form-group">
                        <strong>Category:</strong>
                        @if(!empty(\App\Models\Category::where('id',$ebook->category_id)->first()))
                            {{\App\Models\Category::where('id',$ebook->category_id)->first()->name}}
                        @else
                            <span>N/A</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <strong>Author:</strong>
                        {{ $ebook->author }}
                    </div>
                    <div class="form-group">
                        <a href="{{asset($ebook->ebook_file)}}" class="btn btn-primary btn-sm" target="_blank">Download Ebook</a>
                    </div>
                    <div class="form-group" style="padding: 20px 5%;margin-top: 20px; background-color: #fafafa;">
                        {!! $ebook->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
