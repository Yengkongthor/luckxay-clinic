{{-- <div>
    <h1>Hello Content</h1>
</div> --}}

@extends('admin.layout.default')
@section('title', 'all content')

@section('content')
    <div class="container">
        <h2 style="margin-top: 100px">All Contents</h2>
        <div style="text-align: right">
            <a class="btn btn-primary   btn-sm pull-right m-b-0" href="{{ url('admin/content/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; new content</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contents as $content)
                <tr>
                    <td>{{ $content->id }}</td>
                    <td>{{ $content->title }}</td>
                    <td>{{ $content->content }}</td>
                    <td>
                        @if ($content->image)
                        <img src="{{ asset('images/' . $content->image) }}" alt="Image" style="max-width: 100px;">
                        @else
                        No Image
                        @endif
                    </td>
                    <td>
                        <a href="/admin/content/{{ $content->id }}/show" class="btn btn-info btn-sm">View</a>
                        <a href="/admin/content/{{ $content->id }}/edit" class="btn btn-primary btn-sm">Edit</a>
                        <form action="/admin/content/{{ $content->id }}/delete" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this content?')">Delete</button>
                        </form>
                        {{-- <a href="{{ route('admin.contents.show', $content->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.contents.edit', $content->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('admin/contents.destroy', $content->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this content?')">Delete</button>
                        </form> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection