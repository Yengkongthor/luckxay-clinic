@extends('admin.layout.default')

@section('title', 'edit content')

@section('content')
    <div class="container" style="margin-top: 100px">
        <h2>Edit Content</h2>
        <div>
            {{$content->id}}
        </div>
        <form method="POST" action="{{ url('admin/content', $content->id) }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $content->title }}" required>
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" rows="6" required>{{ $content->content }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                @if($content->image)
                    <img src="{{ asset('images/' . $content->image) }}" alt="Current Image" style="max-width: 200px;">
                @else
                    <p>No Image</p>
                @endif
                <input type="file" class="form-control-file" id="image" name="image">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection