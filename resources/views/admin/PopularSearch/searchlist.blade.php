@extends('admin.layout.layout')
@section('panel')
<div class="container">
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <h1>Popular Search</h1>
        </div>
        <div class="col-auto">
            <a class="btn btn-primary mt-2" href="{{ route('popularsearch.create')}}">Add New Search</a>
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
                <th>Search Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($searches as $search)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $search->search }}</td>


                    <td>
                        <a href="{{ route('popularsearch.edit', $search->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form action="{{ route('popularsearch.destroy', $search->id) }}" method="POST" style="display:inline;">
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
        {{ $searches->links() }}
    </div>
</div>


@endsection
