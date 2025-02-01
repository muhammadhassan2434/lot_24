@extends('admin.layout.layout')
@section('panel')
<div class="container">
    <h1>Edit</h1>

    <form action="{{ route('influencer.update', $influencer->id) }}" method="POST" >
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $influencer->name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $influencer->email }}" required>
        </div>
        <div class="form-group">
            <label for="designation">Designation</label>
            <input type="text" name="designation" class="form-control" value="{{ $influencer->designation }}">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
