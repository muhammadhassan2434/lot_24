@extends('admin.layout.layout')
@section('panel')
<div class="container">
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <h1>Headers</h1>
        </div>
        <div class="col-auto">
            <a class="btn btn-primary mt-2" href="{{ route('header.create')}}">Add New Header</a>
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
                <th>Icon</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($header as $header)
                <tr>
                    <td>{{$loop->iteration }}</td>
                    <td> @if($header->icon)
                        <img src="{{ asset('uploads/' . $header->icon) }}" alt="" width="100" height="70">
                    @else
                        No Image
                    @endif</td>
                    <td>{{ $header->description }}</td>


                    <td>
                        <a href="{{ route('header.edit', $header->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form action="{{ route('header.destroy', $header->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>


@endsection
