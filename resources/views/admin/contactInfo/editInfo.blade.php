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
    <h1>Edit Contact Info</h1>

    <!-- Display success or error messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form to edit category -->
    <div class="col-6">
        <form action="{{ route('contactInfo.update', $contact_info->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $contact_info->phone) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $contact_info->email) }}" required>
            </div>

            <div class="form-group">
                <label for="company_info">Company Info</label>
                <textarea name="company_info" id="company_info" class="form-control" required>{{ old('company_info', $contact_info->company_info) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update</button>
            <a href="{{ route('contactInfo.index') }}" class="btn btn-secondary mt-3">Back</a>
        </form>
    </div>
</div>

@endsection
