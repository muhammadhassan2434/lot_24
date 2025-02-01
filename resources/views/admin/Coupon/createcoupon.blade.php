@extends('admin.layout.layout')
@section('panel.css')
@endsection

@section('panel')

<div class="container ">
    <h1>Add New Influencer</h1>

    <!-- Display success or error messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form to add new category -->
    <div class="col-6">
    <form action="{{ route('coupon.store')}}" method="POST" >
        @csrf
        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" name="code" id="code" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="discount">Discount</label>
            <input type="text" name="discount" id="discount" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="influencer_id">Influencer</label>
            <select name="influencer_id" id="influencer_id" class="form-control" required>
                <option value="">-- Select Influencer --</option>
                @foreach($influencer as $influencer)
                    <option value="{{ $influencer->id }}">{{ $influencer->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="expiry_date">expiry_date</label>
            <input type="date" name="expiry_date" id="expiry_date" class="form-control" required>
        </div>
        <div class="form-group status">
            <label for="status">Status</label>
            <select id="" name="status" class="form-control">
                <option value="active">Active</option>
                <option value="block">Block</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Save</button>
        <a href="{{ route('coupon.index')}}" class="btn btn-secondary mt-3">Back</a>
    </form>
</div>
</div>

@endsection
