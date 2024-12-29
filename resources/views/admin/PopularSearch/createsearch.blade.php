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
    <h1>Add New Search</h1>

    <!-- Display success or error messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form to add new category -->
    <div class="col-6">
    <form action="{{ route('popularsearch.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="icon">Search Title</label>
            <input type="text" name="search" id="search" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Save</button>
        <a href="{{ route('popularsearch.index')}}" class="btn btn-secondary mt-3">Back</a>
    </form>
</div>
</div>

@endsection
