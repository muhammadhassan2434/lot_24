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
    <h1>Add New Topbar</h1>

    <!-- Display success or error messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form to add new category -->
    <div class="col-6">
    <form action="{{ route('topbar.store')}}" method="POST" >
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug">
                </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="color">Color</label>
            <input type="text" name="color" id="color" class="form-control" placeholder="HexCode">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Save</button>
        <a href="{{ route('topbar.index')}}" class="btn btn-secondary mt-3">Back</a>
    </form>
</div>
</div>

@endsection
