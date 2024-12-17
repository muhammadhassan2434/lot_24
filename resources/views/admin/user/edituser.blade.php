@extends('admin.layout.layout')
@section('panel')
<div class="container">
    <h1>Edit User</h1>

    <form action="{{ route('user.update', $user->id) }}" method="POST" >
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">User Name</label>
            <input type="text" name="name" id="name" value="{{old('name', $user->name) }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email <Address></Address></label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control" placeholder="">
        </div>
        <div class="form-group status">
            <label for="role">Role</label>
            <select id="" name="role" class="form-control">
                <option value="customer" {{ $user->role ? 'selected' : '' }}>Customer</option>
               
                <option value="admin" {{ !$user->role ? 'selected' : '' }}>Admin</option>
                <option value="superadmin" {{ !$user->role ? 'selected' : '' }}>Super-Admin</option>

            </select>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" value="" class="form-control" >
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update User</button>
    </form>
</div>
@endsection
