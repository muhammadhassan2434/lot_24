@extends('admin.layout.layout')
@section('panel')
<div class="container">
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <h1>Brands</h1>
        </div>
        <div class="col-auto">
            <a class="btn btn-primary mt-2" href="{{ route('brand.create')}}">Add New Brand</a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add New Category Form -->




    <!-- Categories List -->
    <table class="table table-bordered overflow-scroll">
        <thead>
            <tr>
                <th>ID</th>
                <th>Logo</th>
                <th>Brand Name</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brands as $brand)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td> @if($brand->image)
                        <img src="{{ asset('uploads/' . $brand->image) }}" alt="{{ $brand->name }}" width="100" height="70">
                    @else
                        No Image
                    @endif</td>
                    <td>{{ $brand->name }}</td>
                    <td>{{ $brand->slug }}</td>

                    <td>{{ $brand->status }}</td>

                    <td>
                        <a href="{{ route('brand.edit', $brand->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form action="{{ route('brand.destroy', $brand->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $brands->links() }}
    </div>
</div>


@endsection
