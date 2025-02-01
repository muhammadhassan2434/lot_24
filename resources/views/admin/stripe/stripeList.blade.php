@extends('admin.layout.layout')
@section('panel')
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <h1>Stripe's</h1>
            </div>
            <div class="col-auto">
                <a class="btn btn-primary mt-2" href="{{ route('stripe.create') }}">Add New Stripe Account</a>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Add New Category Form -->




        <!-- Categories List -->
        <table class="table table-bordered overflow-scroll">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Secret Key</th>
                    <th>Publisher Key</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stripes as $stripe)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{$stripe->secretkey}}
                        </td>
                        <td>{{ $stripe->publisherkey }}</td>


                        <td>
                            <a href="{{ route('stripe.edit', $stripe->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('stripe.destroy', $stripe->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
