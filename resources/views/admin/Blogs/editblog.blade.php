@extends('admin.layout.layout')
@section('panel')
<div class="container">
    <h1>Edit Blog</h1>

    <form action="{{ route('blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Current image</label>
            <div class="row">
                    <div class="col-md-3 text-center">
                        <img src="{{ asset('uploads/' . $blog->image) }}" alt="" width="100">
                    </div>
            </div>
        </div>
        <div class="form-group">
            <label for="new_image">Add New Icon (Optional)</label>
            <input type="file" name="new_image" id="new_image" class="form-control">
            <small class="form-text text-muted">Leave blank if you do not want to change the image.</small>
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $blog->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" class="form-control" value="{{ $blog->description }}" required>
        </div>


        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
