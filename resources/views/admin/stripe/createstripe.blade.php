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
    <h1>Add New Stripe Account</h1>

    <!-- Display success or error messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form to add new category -->
    <div class="col-6">
    <form action="{{ route('stripe.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="secretkey">Secret Key</label>
            <input type="text" name="secretkey" id="secretkey" class="form-control">
        </div>
        <div class="form-group">
            <label for="publisherkey">Publisher Key</label>
            <input type="text" name="publisherkey" id="publisherkey" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Save</button>
        <a href="{{ route('stripe.index')}}" class="btn btn-secondary mt-3">Back</a>
    </form>
</div>
</div>

@endsection
