@extends('admin.layout.layout')
@section('panel')
<div class="container">
    <h1>Edit Category</h1>

    <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
        </div>
        <div class="form-group">
            <label for="slug">Slug (Optional)</label>
            <input type="text" name="slug" class="form-control" value="{{ $category->slug }}">
        </div>
        <div class="form-group">
            <label>Current Product Images</label>
            <div class="row">
                    <div class="col-md-3 text-center">
                        <img src="{{ asset('uploads/' . $category->image) }}" alt="{{ $category->name }}" width="100">
                    </div>
            </div>
        </div>



        <!-- New Images Upload -->
        <div class="form-group">
            <label for="new_image">Add New Image (Optional)</label>
            <input type="file" name="new_image" id="new_image" class="form-control">
            <small class="form-text text-muted">Leave blank if you do not want to change the image.</small>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" required>
                <option value="active" {{ $category->status === 'active' ? 'selected' : '' }}>Active</option>
                <option value="block" {{ $category->status === 'block' ? 'selected' : '' }}>Block</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update Category</button>
    </form>
</div>
@endsection
