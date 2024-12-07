@extends('admin.layout.layout')
@section('panel')
<div class="container">
    <h1>Edit Buyer/Seller</h1>

    <form action="{{ route('accounts.update', $account->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-control" required>
                <option value="buyer" {{ old('role', $account->role) == 'buyer' ? 'selected' : '' }}>Buyer</option>
                <option value="seller" {{ old('role', $account->role) == 'seller' ? 'selected' : '' }}>Seller</option>
            </select>
        </div>
        <div class="form-group">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $account->name) }}" required>
        </div>
        <div class="form-group">
            <label for="surname" class="form-label">Surname</label>
            <input type="text" name="surname" id="surname" class="form-control" value="{{ old('surname', $account->surname) }}" required>
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $account->email) }}" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" value="" class="form-control" >
        </div>
        <div class="form-group">
            <label for="subscription_id">Subscription</label>
            <select name="subscription_id" id="subscription_id" class="form-control" required>
                <option value="">-- Select Subscription --</option>
                @foreach($subscription as $subscription)
                    <option value="{{ $subscription->id }}" {{ $account->subscription_id == $subscription->id ? 'selected' : '' }}>
                        {{ $subscription->plan_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="country_code" class="form-label">Country Code</label>
            <input type="text" name="country_code" id="country_code" class="form-control" value="{{ old('country_code', $account->country_code) }}">
        </div>
        <div class="form-group">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number', $account->phone_number) }}">
        </div>

        <div class="form-group">
            <label for="country" class="form-label">Country</label>
            <input type="text" name="country" id="country" class="form-control" value="{{ old('country', $account->country) }}" required>
        </div>


        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
