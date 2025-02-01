@extends('admin.layout.layout')
@section('panel')
<div class="container">
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <h1>Contacts</h1>
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




    <!-- Categories List -->

    <table class="table table-bordered overflow-auto">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Status</th>
                <th>Actions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->massage}}</td>


                    <td>
                        <span class="badge badge-{{ $contact->status === 'unread' ? 'danger' : 'success' }}">
                            {{ ucfirst($contact->status) }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-primary view-contact" data-id="{{ $contact->id }}" data-url="{{ route('contact.show', $contact->id) }}">
                            View
                        </button>
                        <button class="btn btn-dark reply-contact" data-id="{{ $contact->id }}" data-email="{{ $contact->email }}" data-bs-toggle="modal" data-bs-target="#replyModal">
                            Reply
                        </button>
                        

                    </td>
                    <td>
                        <form action="{{ route('contact.destroy', $contact->id) }}" method="POST" style="display:inline;">
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
        {{ $contacts->links() }}
    </div>
</div>


<!-- Reply Modal -->
<div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="replyForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="replyModalLabel">Reply to User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="contactId" name="contact_id">
                    <div class="mb-3">
                        <label for="replyMessage" class="form-label">Message</label>
                        <textarea class="form-control" id="replyMessage" name="message" rows="5" placeholder="Write your message here..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('panel.js')
<script>
   $(document).ready(function () {
    $('.view-contact').click(function () {
        let contactId = $(this).data('id'); // Fetch the contact ID
        let viewUrl = $(this).data('url'); // Fetch the URL for the details page

        // Update the status to "read" before navigating
        $.ajax({
            url: '/admin/contact/status-update',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: contactId,
                status: 'read',
            },
            success: function (response) {
                // Check if the response contains status: true
                if (response.status === true) {
                    window.location.href = viewUrl; // Redirect to the details page
                } else {
                    // Display the server-provided message or a fallback error
                    alert('Failed to update status: ' + (response.message || 'Unknown error.'));
                }
            },
            error: function (xhr) {
                // Display detailed error message if the request fails
                alert('An error occurred: ' + xhr.responseText);
            },
        });
    });
});

</script>
<script>
    $(document).ready(function () {
        $('.reply-contact').click(function () {
            let contactId = $(this).data('id');
            let contactEmail = $(this).data('email');
            $('#contactId').val(contactId);
        });
    
        $('#replyForm').submit(function (e) {
            e.preventDefault();
    
            let formData = $(this).serialize();
    
            $.ajax({
                url: '{{ route("contact.reply") }}', // Update with the correct route
                method: 'POST',
                data: formData,
                success: function (response) {
                    if (response.status) {
                        alert('Reply sent successfully!');
                        $('#replyModal').modal('hide');
                    } else {
                        alert('Failed to send reply: ' + response.message);
                    }
                },
                error: function (xhr) {
                    alert('An error occurred: ' + xhr.responseText);
                },
            });
        });
    });
    </script>
    
@endsection
