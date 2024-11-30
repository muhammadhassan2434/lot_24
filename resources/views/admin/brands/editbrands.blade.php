@extends('admin.layout.layout')
@section('panel')
<div class="container">
    <h1>Edit Brand</h1>

    <form action="{{ route('brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Current Logo</label>
            <div class="row">
                    <div class="col-md-3 text-center">
                        <img src="{{ asset('uploads/' . $brand->image) }}" alt="{{ $brand->name }}" width="100">
                    </div>
            </div>
        </div>
        <div class="form-group">
            <label for="new_image">Add New Image (Optional)</label>
            <input type="file" name="new_image" id="new_image" class="form-control">
            <small class="form-text text-muted">Leave blank if you do not want to change the image.</small>
        </div>
        <div class="form-group">
            <label for="name">Brand Name</label>
            <input type="text" name="name" class="form-control" value="{{ $brand->name }}" required>
        </div>
        <div class="form-group">
            <label for="slug">Slug (Optional)</label>
            <input type="text" name="slug" class="form-control" value="{{ $brand->slug }}">
        </div>




        <!-- New Images Upload -->

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" required>
                <option value="active" {{ $brand->status ? 'selected' : '' }}>Active</option>
                <option value="block" {{ !$brand->status ? 'selected' : '' }}>Block</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
