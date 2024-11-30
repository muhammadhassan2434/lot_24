
@extends('admin.layout.layout')
@section('panel')

<div class="container">
    <h1>Add New Country</h1>

    <!-- Display success or error messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form to add new subcategory -->
    <form action="{{ route('country.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Country Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="iso_code">ISO_Code</label>
            <input type="text" name="iso_code" id="iso_code" class="form-control">
        </div>
        <div class="form-group">
            <label for="dail_code">Dail_Code</label>
            <input type="text" name="dail_code" id="dail_code" class="form-control">
        </div>
        <div class="form-group">
            <label for="currency">Currency</label>
            <input type="text" name="currency" id="currency" class="form-control">
        </div><div class="form-group">
            <label for="currency_symbol">Currency_Symbol</label>
            <input type="text" name="currency_symbol" id="currency_symbol" class="form-control">
        </div><div class="form-group">
            <label for="time_zone">Time_Zone</label>
            <input type="text" name="time_zone" id="time_zone" class="form-control">
        </div><div class="form-group">
            <label for="region">Region</label>
            <input type="text" name="region" id="region" class="form-control">
      </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="" class="form-control" required>
                <option value="active">Active</option>
                <option value="block">Block</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Save Country</button>
        <a href="{{ route('country.index') }}" class="btn btn-secondary mt-3">Back to Countries_List</a>
    </form>
</div>
@endsection
