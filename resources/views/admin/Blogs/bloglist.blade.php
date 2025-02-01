@extends('admin.layout.layout')
@section('panel')
<div class="container">
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <h1>Blog's</h1>
        </div>
        <div class="col-auto">
            <a class="btn btn-primary mt-2" href="{{ route('blog.create')}}">Add New Blog</a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add New Category Form -->




    <!-- Categories List -->
    <table class="table table-bordered overflow-scroll">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($blogs as $blog)
                <tr>
                    <td>{{ $loop->iteration}}</td>
                    <td> @if($blog->image)
                        <img src="{{ asset('uploads/' . $blog->image) }}" alt="" width="100" height="70">
                    @else
                        No Image
                    @endif</td>
                    <td>{{ $blog->title }}</td>
                    <td>{{ $blog->description }}</td>


                    <td>
                        <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form action="{{ route('blog.destroy', $blog->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $blogs->links() }}
    </div>
</div>


@endsection
