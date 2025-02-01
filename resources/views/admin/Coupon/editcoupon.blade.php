@extends('admin.layout.layout')
@section('panel')
<div class="container">
    <h1>Edit</h1>

    {{-- if any error comes show error  --}}
    {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            </ul>
            </div>



@endif --}}

    <form action="{{ route('coupon.update', $coupon->id) }}" method="POST" >
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" name="code" id="code"  value="{{ $coupon->code}}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="discount">Discount</label>
            <input type="text" name="discount" id="discount" value="{{$coupon->discount}}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="influencer_id">Influencer</label>
            <select name="influencer_id" id="influencer_id" class="form-control" required>
                <option value="">-- Select Influencer --</option>
                @foreach($influencers as $influencer)
                    <option value="{{ $influencer->id }}" {{ $coupon->influencer_id == $influencer->id ? 'selected' : '' }}>
                        {{ $influencer->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="expiry_date">Expiry Date</label>
            <input type="text" name="expiry_date" id="expiry_date" value="{{$coupon->expiry_date}}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" required>
                <option value="active" {{ $coupon->status ? 'selected' : '' }}>Active</option>
                <option value="block" {{ !$coupon->status ? 'selected' : '' }}>Block</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
