@extends('admin.layout.layout')
@section('panel')
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <h1>Coupon Usage List</h1>
            </div>
            {{-- <div class="col-auto">
                <a class="btn btn-primary mt-2" href="{{ route('color.create') }}">Add New color</a>
            </div> --}}
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
                    <th>Name</th>
                    <th>Coupon Code </th>
                    <th>Influencer Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accounts as $account)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>
            {{ $account->name }} {{ $account->surname }}
        </td>
        <td>{{ $account->coupon->code ?? 'N/A' }}</td>
        <td>{{ $account->coupon->influencer->name ?? 'N/A' }}</td>
    </tr>
@endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $accounts->links() }}
        </div>
    </div>
@endsection
