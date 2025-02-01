@extends('admin.layout.layout')
@section('panel')
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <h1>Contact Info </h1>
            </div>
            <div class="col-auto">
                <a class="btn btn-primary mt-2" href="{{ route('contactInfo.create') }}">Add Contact Info</a>
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
                    <th>Phone</th>
                    <th>Email </th>
                    <th>Company Info </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contactInfos as $contactInfo)
                    <tr>
                        <td>{{ $contactInfo->id }}</td>
                        <td>{{ $contactInfo->phone }}</td>
                        <td>
                            {{$contactInfo->email}}
                        </td>
                        <td>{{ $contactInfo->company_info }}</td>


                        <td>
                            <a href="{{ route('contactInfo.edit', $contactInfo->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('contactInfo.destroy', $contactInfo->id) }}" method="POST" style="display:inline;">
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
        <div class="d-flex justify-content-center">
            {{-- {{ $colors->links() }} --}}
        </div>
    </div>
@endsection
