@extends('admin.layout.default')
@section('title', 'Detail')

@section('content')
    <div class="container" style="margin-top: 100px">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('images/' . $content->image) }}" alt="Content Image" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h2>{{ $content->title }}</h2>
                <p>{{ $content->content }}</p>
                <!-- Additional content details or information -->
            </div>
        </div>
    </div>
@endsection