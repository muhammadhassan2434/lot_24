@extends('admin.layout.layout')
@section('panel')
<div class="container">
    <h1>Edit Topbar</h1>

    <form action="{{ route('topbar.update', $topbar->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" value="{{ $topbar->title }}" class
            ="form-control" id="title" placeholder="Enter title">
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" value="{{ $topbar->slug }}" class="form-control" >
                </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" class="form-control" value="{{ $topbar->description }}" required>
        </div>
        <div class="form-group">
            <label for="color">Color</label>
            <input type="text" name="color" value="{{ $topbar->color }}" class="form-control" placeholder="Hexcode of color">
            </div>


        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
