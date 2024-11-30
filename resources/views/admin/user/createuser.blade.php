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
    <h1>Add New User</h1>

    <!-- Display success or error messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form to add new category -->
    <div class="col-6">
    <form action="{{ route('user.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">User Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email <Address></Address></label>
            <input type="email" name="email" id="email" class="form-control" placeholder="">
        </div>
        <div class="form-group status">
            <label for="role">Role</label>
            <select id="" name="role" class="form-control">
                <option value="customer">Customer</option>
                <option value="seller">Seller</option>
                <option value="admin">Admin</option>
                <option value="superadmin">Super-Admin</option>

            </select>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" >
        </div>

        <button type="submit" class="btn btn-primary mt-3">Save</button>
        <a href="{{ route('user.index')}}" class="btn btn-secondary mt-3">Back</a>
    </form>
</div>
</div>

@endsection
