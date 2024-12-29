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
    <h1>Add New Blog</h1>

    <!-- Display success or error messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form to add new category -->
    <div class="col-6">
    <form action="{{ route('blog.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" >
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" class="form-control" required>
        </div>


        <button type="submit" class="btn btn-primary mt-3">Save</button>
        <a href="{{ route('blog.index')}}" class="btn btn-secondary mt-3">Back</a>
    </form>
</div>
</div>

@endsection
