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
    <h1>Add New Subscription</h1>

    <!-- Display success or error messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form to add new category -->
    <div class="col-6">
    <form action="{{ route('store.data')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="plan_name">Name</label>
            <input type="text" name="plan_name" id="plan_name" class="form-control"  >
        </div>
        <label for="Actual_Price">Actual_Price</label>
        <input type="text" name="Actual_Price" id="Actual_Price" class="form-control">

        <div class="form-group">
            <label for="Discount_Price">Discounted_Price</label>
            <input type="text" name="Discount_Price" id="Discount_Price" class="form-control" >
        </div>
        <div class="form-group">
            <label for="plan_duration">Plan_Duration</label>
            <input type="text" name="plan_duration" id="plan_duration" class="form-control" >
        </div>
        <div class="form-group status">
            <label for="status">Status</label>
            <select id="" name="status" class="form-control">
                <option value="active">Active</option>
                <option value="block">Block</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Save</button>
        <a href="{{ route('subscription.index')}}" class="btn btn-secondary mt-3">Back</a>
    </form>
</div>
</div>

@endsection
