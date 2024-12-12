@extends('admin.layout.layout')
@section('panel')
<div class="container">
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <h1>Contact Detail</h1>
        </div>
        {{-- <div class="col-auto">
            <a class="btn btn-primary mt-2" href="{{ route('brand.create')}}">Add New Brand</a>
        </div> --}}
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add New Category Form -->


    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4 font-weight-bold">Name:</div>
                    <div class="col-md-8">{{ $contact->name }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 font-weight-bold">Email:</div>
                    <div class="col-md-8">{{ $contact->email }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 font-weight-bold">Message:</div>
                    <div class="col-md-8">{{ $contact->massage }}</div>
                </div>
            </div>
</div>
<div class="mb-3">
    <button class="btn btn-danger"><a class="text-white" href="{{ route('contact.index')}}">Back</a></button>
</div>

@endsection
@section('panel.js')
<script>
    $(document).ready(function () {
    $('.update-status').change(function () {
        let ContactId = $(this).data('id');
        let status = $(this).val();

        $.ajax({
            url: '/admin/contact/status-update', // Your route here
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: ContactId,
                status: status,
            },
            success: function (response) {
                if (response.status) {
                    alert('Failed to update Status');
                } else {
                    alert('Message Read successfully');
                }
            },
            error: function (xhr, status, error) {
                alert('An error occurred: ' + xhr.responseText);
            },
        });
    });
});
</script>
@endsection