@extends('admin.layout.layout')
@section('panel')
<div class="container">
    <h1>Edit Search</h1>

    <form action="{{ route('popularsearch.update', $search->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="search">Search Title</label>
            <input type="text" name="search" class="form-control" value="{{ $search->search }}" required>
        </div>


        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
