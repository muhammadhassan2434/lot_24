@extends('admin.layout.layout')
@section('panel')
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <h1>Social Media</h1>
            </div>
            <div class="col-auto">
                <a class="btn btn-primary mt-2" href="{{ route('media.create') }}">Add New Media</a>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Add New Category Form -->




        <!-- Categories List -->
        <table class="table table-bordered overflow-scroll">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Link</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medias as $media)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{$media->title}}
                        </td>
                        <td>{{ $media->link }}</td>


                        <td>
                            <a href="{{ route('media.edit', $media->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('media.destroy', $media->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
