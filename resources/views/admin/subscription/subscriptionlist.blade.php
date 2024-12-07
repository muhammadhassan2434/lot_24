@extends('admin.layout.layout')
@section('panel')
<div class="container">
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <h1>Subscriptions</h1>
        </div>
        <div class="col-auto">
            <a class="btn btn-primary mt-2" href="{{ route('subscription.create')}}">Add New Subscriptions</a>
        </div>
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
                <th>Name</th>
                <th>Actual_Price</th>
                <th>Discount_price</th>
                <th>Duration</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subscription as $subscription)
                <tr>
                    <td>{{ $subscription->id }}</td>
                    <td>{{ $subscription->plan_name }}</td>
                    <td>{{ $subscription->Actual_Price}}</td>
                    <td>{{ $subscription->Discount_Price}}</td>
                    <td>{{ $subscription->plan_duration}}</td>
                    <td>{{ $subscription->status}}</td>

                    <td>
                        <a href="{{ route('subscription.edit', $subscription->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                        {{-- <form action="{{ route('subscription.destroy', $subscription->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection
