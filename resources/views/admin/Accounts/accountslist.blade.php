@extends('admin.layout.layout')
@section('panel')
<div class="container">
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <h1>Buyer's/Seller's</h1>
        </div>
        {{-- <div class="col-auto">
            <a class="btn btn-primary mt-2" href="{{ route('subscription.create')}}">Add New Subscriptions</a>
        </div> --}}
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add New Category Form -->




    <!-- Categories List -->
    <table class="table table-bordered overflow-scroll">
        <thead>
            <tr>
                <th>ID</th>
                <th>Role</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Phone No</th>
                <th>Country</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($accounts as $account)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $account->role }}</td>
                    <td>{{ $account->name }}</td>
                    <td>{{ $account->surname }}</td>
                    <td>{{ $account->email }}</td>
                    <td>{{ $account->phone_number }}</td>
                    <td>{{ $account->country }}</td>
                    <td>
                        <a href="{{ route('account.edit', $account->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form action="{{ route('accounts.destroy', $account->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $accounts->links() }}
    </div>
</div>


@endsection
