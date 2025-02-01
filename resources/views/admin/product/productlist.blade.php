@extends('admin.layout.layout')
@section('panel.css')
<style>
.update-displaytag{
        border: none;
        padding:5px 4px ;
    }
</style>
@endsection
@section('panel')
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <h1>Products</h1>
            </div>
            <div class="col-auto">
                {{-- <a class="btn btn-primary mt-2" href="{{ route('category.create')}}">Add New Category</a> --}}
            </div>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Add New Category Form -->




        <!-- Categories List -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Images</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Sale Price</th>
                    <th>Whole Sale Price</th>
                    <th>Stock_Status</th>
                    <th>Country</th>
                    <th>Display Tags</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>
                            @foreach ($product->images as $image)
                                @if ($image->image)
                                    <img src="{{ asset($product->images->first()->image) }}" alt="" width="100"
                                        height="70">
                                @else
                                    No Image
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $product->title }}</td>
                        <td>{{$product->category->name }}</td>
                        <td>{{ $product->regular_price }}</td>
                        <td>{{ $product->sale_price }}</td>
                        <td>{{ $product->wholesale_price }}</td>
                        <td>{{ $product->stock_status }}</td>
                        <td>{{ $product->country->name ?? '' }}</td>


                        <td>
                            <select class="update-displaytag form-control" data-id="{{ $product->id }}" >
                                <option value="" {{ $product->displaytag === null ? 'selected' : '' }}>None</option>
                                 <option value="Week best offers"
                                    {{ $product->displaytag === "Week best offers" ? 'selected' : '' }}>Week best offers
                                </option>
                                <option value="Most popular offers"
                                    {{ $product->displaytag === 'Most popular offers' ? 'selected' : '' }}>Most popular
                                    offers</option>
                                <option value="Recently added"
                                    {{ $product->displaytag === 'Recently added' ? 'selected' : '' }}>Recently added
                                </option>
                            </select>
                        </td>

                        <td>
                            <a class="btn btn-primary " href="{{ route('admin.product.detail', $product->id) }}">
                                View
                            </a>


                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $products->links('vendor.pagination.bootstrap-4') }}
        </div>
        
        </div>
@endsection
@section('panel.js')
<script>
    $(document).ready(function () {
    $('.update-displaytag').change(function () {
        let productId = $(this).data('id');
        let displaytag = $(this).val();

        $.ajax({
            url: '/admin/products/update-displaytag', // Your route here
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: productId,
                displaytag: displaytag,
            },
            success: function (response) {
                if (response.status) {
                    alert('Failed to update display tag');
                } else {
                    alert('Display tag updated successfully');
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
