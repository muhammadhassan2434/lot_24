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
    <h1>Edit Header</h1>

    <!-- Display success or error messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form to edit category -->
    <div class="col-6">
    <form action="{{ route('color.update', $color->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="icon">Title</label>
            <input type="text" name="title" id="" class="form-control" value="{{ old('title', $color->title) }}">
        </div>
        <div class="form-group">
            <label for="description">Color Hex Code</label>
            <input type="text" name="color" id="color" class="form-control" value="{{ old('color', $color->color) }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
        <a href="{{ route('color.index')}}" class="btn btn-secondary mt-3">Back</a>
    </form>
</div>
</div>

@endsection
