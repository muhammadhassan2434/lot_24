@extends('admin.layout.layout')
@section('panel')
<div class="container">
    <h1>Edit Review</h1>

    <form action="{{ route('review.update', $review->id) }}" method="POST" >
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $review->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" class="form-control" value="{{ $review->description }}">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
