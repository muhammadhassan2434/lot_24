@extends('admin.layout.layout')
@section('panel')

<div class="container">
    <h1>Edit Subcategory</h1>

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

    <!-- Form to edit subcategory -->
    <form action="{{ route('subcategory.update', $subcategory->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Subcategory Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $subcategory->name) }}" required>
        </div>

        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="slug">Slug (Optional)</label>
            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $subcategory->slug) }}" placeholder="">
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="" class="form-control" required>
                <option value="active" {{ $subcategory->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="block" {{ $subcategory->status == 0 ? 'selected' : '' }}>Block</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Subcategory</button>
        <a href="{{ route('subcategory.index') }}" class="btn btn-secondary mt-3">Back to Subcategories</a>
    </form>
</div>
@endsection

