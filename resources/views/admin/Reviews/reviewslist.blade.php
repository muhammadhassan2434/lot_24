@extends('admin.layout.layout')
@section('panel')
<div class="container">
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <h1>Reviews</h1>
        </div>
        <div class="col-auto">
            <a class="btn btn-primary mt-2" href="{{ route('review.create')}}">Add New Review</a>
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
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
                    <td>{{$review->id}}</td>
                    <td>{{ $review->name }}</td>
                    <td>{{ $review->description }}</td>

                    <td>
                        <a href="{{ route('review.edit', $review->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form action="{{ route('review.destroy', $review->id) }}" method="POST" style="display:inline;">
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