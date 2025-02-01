@extends('admin.layout.layout')
@section('panel.css')
<style>
#status {
    display: flex !important;
    visibility: visible !important;
}
</style>
@endsection

@section('panel')

<div class="container ">
    <h1>Edit Conditions</h1>

    <!-- Display success or error messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form to edit category -->
    <div class="col-6">
    <form action="{{ route('term.update', $terms->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $terms->title) }}">
        </div>
        <div class="form-group">
            <label for="Description">Description</label>
            <input type="text" name="Description" id="Description" class="form-control" value="{{ old('Description', $terms->Description) }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
        <a href="{{ route('term.index')}}" class="btn btn-secondary mt-3">Back</a>
    </form>
</div>
</div>

@endsection
