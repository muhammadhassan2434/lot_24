@extends('admin.layout.layout')
@section('panel.css')
@endsection

@section('panel')

<div class="container ">
    <h1>Add New Influencer</h1>

    <!-- Display success or error messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form to add new category -->
    <div class="col-6">
    <form action="{{ route('influencer.store')}}" method="POST" >
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="designation">designation</label>
            <input type="text" name="designation" id="designation" class="form-control" placeholder="Such as Youtuber or instagramer">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Save</button>
        <a href="{{ route('influencer.index')}}" class="btn btn-secondary mt-3">Back</a>
    </form>
</div>
</div>

@endsection
