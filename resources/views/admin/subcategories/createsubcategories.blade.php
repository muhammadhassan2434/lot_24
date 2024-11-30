
@extends('admin.layout.layout')
@section('panel')

<div class="container">
    <h1>Add New Subcategory</h1>

    <!-- Display success or error messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form to add new subcategory -->
    <form action="{{ route('subcategory.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Subcategory Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="slug">Slug (Optional)</label>
            <input type="text" name="slug" id="slug" class="form-control" placeholder="">
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="" class="form-control" required>
                <option value="active">Active</option>
                <option value="block">Block</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Save Subcategory</button>
        <a href="{{ route('subcategory.index') }}" class="btn btn-secondary mt-3">Back to Subcategories</a>
    </form>
</div>
@endsection
