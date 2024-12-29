@extends('admin.layout.layout')
@section('panel')
<div class="container">
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <h1>Top Bar's</h1>
        </div>
        <div class="col-auto">
            <a class="btn btn-primary mt-2" href="{{ route('topbar.create')}}">Add New Topbar</a>
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
                <th>title</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Color</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($topbars as $topbar)
                <tr>
                    <td>{{ $topbar->id }}</td>
                    <td>{{ $topbar->title }}</td>
                    <td>{{ $topbar->slug }}</td>
                    <td>{{ $topbar->description }}</td>
                    <td>{{ $topbar->color }}</td>

                    <td>
                        <a href="{{ route('topbar.edit', $topbar->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form action="{{ route('topbar.destroy', $topbar->id) }}" method="POST" style="display:inline;">
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
