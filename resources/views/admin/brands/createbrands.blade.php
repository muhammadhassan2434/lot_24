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
    <h1>Add New Brand</h1>

    <!-- Display success or error messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form to add new category -->
    <div class="col-6">
    <form action="{{ route('brand.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">Brand Logo</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
        </div>
        <div class="form-group">
            <label for="name">Brand Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="slug">Slug (Optional)</label>
            <input type="text" name="slug" id="slug" class="form-control" placeholder="">
        </div>

        <div class="form-group status">
            <label for="status">Status</label>
            <select id="" name="status" class="form-control">
                <option value="active">Active</option>
                <option value="block">Block</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Save</button>
        <a href="{{ route('brand.index')}}" class="btn btn-secondary mt-3">Back</a>
    </form>
</div>
</div>

@endsection
