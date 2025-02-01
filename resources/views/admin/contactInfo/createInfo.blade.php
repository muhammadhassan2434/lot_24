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
    <h1>Add New Color's</h1>

    <!-- Display success or error messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form to add new category -->
    <div class="col-6">
    <form action="{{ route('contactInfo.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="icon">Phone</label>
            <input type="text" name="phone" id="" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Email </label>
            <input type="email" name="email" id="color" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Company Info </label>
            <textarea type="email" name="company_info" id="color" class="form-control" required> </textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Save</button>
        <a href="{{ route('color.index')}}" class="btn btn-secondary mt-3">Back</a>
    </form>w
</div>
</div>

@endsection
