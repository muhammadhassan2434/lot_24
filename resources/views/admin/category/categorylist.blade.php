@extends('admin.layout.layout')
@section('panel')
<div class="container">
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <h1>Categories</h1>
        </div>
        <div class="col-auto">
            <a class="btn btn-primary mt-2" href="{{ route('category.create')}}">Add  Category</a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add New Category Form -->




    <!-- Categories List -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Slug</th>
                <th>Image</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td> @if($category->image)
                        <img src="{{ asset('uploads/' . $category->image) }}" alt="{{ $category->name }}" width="100" height="70">
                    @else
                        No Image
                    @endif</td>
                    <td>{{ $category->status }}</td>

                    <td>
                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection
