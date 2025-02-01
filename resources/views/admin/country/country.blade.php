@extends('admin.layout.layout')

@section('panel')
<div class="container">
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <h1>Countries</h1>
        </div>
        <div class="col-auto">
            <a class="btn btn-primary mt-2" href="{{ route('country.create') }}">Add New Country</a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Countries List -->
    <div class="table-wrapper overflow-auto">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>ISO_Code</th>
                    <th>Dail_Code</th>
                    <th>Currency</th>
                    <th>Currency_Symbol</th>
                    <th>Time_Zone</th>
                    <th>Region</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($countries as $country)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $country->name }}</td>
                        <td>{{ $country->iso_code }}</td>
                        <td>{{ $country->dail_code }}</td>
                        <td>{{ $country->currency }}</td>
                        <td>{{ $country->currency_symbol }}</td>
                        <td>{{ $country->time_zone }}</td>
                        <td>{{ $country->region }}</td>
                        <td>{{ $country->status }}</td>

                        <td>
                            <a href="{{ route('country.edit', $country->id) }}" class="btn btn-secondary btn-sm m-2 ">Edit</a>
                            <form action="{{ route('country.destroy', $country->id) }}" method="POST" style="display:inline;">
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
            {{ $countries->links() }}
        </div>
    </div>
</div>
@endsection
