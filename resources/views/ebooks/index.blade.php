@extends('layouts.default')
@section('content')
    <main>
        <div class="wrapper">
            <h2>Hi.. {{ Auth::user()->name }}</h2>
        </div>
    </main>
@endsection
