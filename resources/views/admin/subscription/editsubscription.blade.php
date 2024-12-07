@extends('admin.layout.layout')
@section('panel')
<div class="container">
    <h1>Edit Subscription</h1>

    <form action="{{ route('subscription.update', $subscription->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="plan_name">Name</label>
            <input type="text" name="plan_name" class="form-control" value="{{$subscription->plan_name }}" required>
        </div>
        <div class="form-group">
            <label for="plan_duration">Plan_Duration</label>
            <input type="text" name="plan_duration" class="form-control" value="{{ $subscription->plan_duration }}">
        </div>
        <div class="form-group">
            <label for="Actual_Price">Actual_Price</label>
            <input type="text" name="Actual_Price" class="form-control" value="{{ $subscription->Actual_Price }}">
        </div><div class="form-group">
            <label for="Discount_Price">Discounted_Price</label>
            <input type="text" name="Discount_Price" class="form-control" value="{{ $subscription->Discount_Price }}">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" required>
                <option value="active" {{ $subscription->status === 'active' ? 'selected' : '' }}>Active</option>
                <option value="block" {{ $subscription->status === 'block' ? 'selected' : '' }}>Block</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
