@extends('admin.layout.layout')
@section('panel.css')
<style>
.product-details {
        margin-top: 10px;
        font-family: Arial, sans-serif;
    }
    .product-image {
        max-width: 100%;
        height: auto;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 10px;
        background: #f8f9fa;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .product-info {
        margin-top: 15px;
        padding: 20px;
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: grid;
        grid-template-columns: auto auto;
        row-gap: 10px;
        column-gap: 20px;
        align-items: center;
    }
    .product-info dt {
        font-weight: bold;
        color: #333;
    }
    .product-info dd {
        color: #555;
        margin: 0;
    }
    .product-header {
        background: #094382;
        color: #fff;
        padding: 15px;
        border-radius: 10px;
        text-align: center;
        margin-bottom: 20px;
    }
    .action-buttons .btn {
        margin-right: 10px;
    }

</style>



@endsection
@section('panel')
{{-- <div class="container product-details">
    <h1>Product Details</h1>

    <div class="row">
        <div class="col-md-6">
            @if ($product->images && $product->images->first())
                <img src="{{ asset($product->images->first()->image) }}" alt="{{ $product->title }}" class="product-image">
            @else
                <p>No Image Available</p>
            @endif
        </div>
        <div class="col-md-6">
            <dl class="product-info">
                <dt>Product Name:</dt>
                <dd>{{ $product->title ?? 'Null'}}</dd>

                <dt>Description:</dt>
                <dd>{{ $product->description ?? 'Null'}}</dd>

                <dt>Category:</dt>
                <dd>{{ $product->category->name ?? 'Null' }}</dd>

                <dt>Regular Price:</dt>
                <dd>{{ $product->regular_price ?? 'Null' }}</dd>

                <dt>Sale Price:</dt>
                <dd>{{ $product->sale_price ?? 'Null' }}</dd>

                <dt>Wholesale Price:</dt>
                <dd>{{ $product->wholesale_price ?? 'Null'}}</dd>

                <dt>Stock Status:</dt>
                <dd>{{ $product->stock_status ?? 'Null' }}</dd>

                <dt>Country:</dt>
                <dd>{{ $product->country->name ?? 'Null' }}</dd>

                <dt>Display Tags:</dt>
                <dd>{{ $product->displaytag ?? 'Null' }}</dd>

                <dt>Brand:</dt>
                <dd>{{ $product->brand->name  ?? 'Null'}}</dd>

                <dt>SKU:</dt>
                <dd>{{ $product->sku  ?? 'Null'}}</dd>

                <dt>EAN:</dt>
                <dd>{{ $product->ean ?? 'Null' }}</dd>
            </dl>
        </div>
    </div>

</div> --}}
<div class="container product-details">
    <div class="product-header">
        <h1>Product Details</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            @if ($product->images && $product->images->first())
                <img src="{{ asset($product->images->first()->image) }}" alt="{{ $product->title }}" class="product-image">
            @else
                <p>No Image Available</p>
            @endif
        </div>
        <div class="col-md-6">
            <dl class="product-info">
                <dt>Product Name:</dt>
                <dd>{{ $product->title ?? 'Null' }}</dd>

                <dt>Description:</dt>
                <dd>{{ $product->description ?? 'Null' }}</dd>

                <dt>Category:</dt>
                <dd>{{ $product->category->name ?? 'Null' }}</dd>

                <dt>Regular Price:</dt>
                <dd>{{ $product->regular_price ?? 'Null' }}</dd>

                <dt>Sale Price:</dt>
                <dd>{{ $product->sale_price ?? 'Null' }}</dd>

                <dt>Wholesale Price:</dt>
                <dd>{{ $product->wholesale_price ?? 'Null' }}</dd>

                <dt>Stock Status:</dt>
                <dd>{{ $product->stock_status ?? 'Null' }}</dd>

                <dt>Display Tags:</dt>
                <dd>{{ $product->displaytag ?? 'Null' }}</dd>

                <dt>Brand:</dt>
                <dd>{{ $product->brand->name ?? 'Null' }}</dd>

                <dt>SKU:</dt>
                <dd>{{ $product->sku ?? 'Null' }}</dd>

                <dt>EAN:</dt>
                <dd>{{ $product->ean ?? 'Null' }}</dd>


                <dt>Payment Method:</dt>
                <dd>{{ $product->payment_option ?? 'Null' }}</dd>

                <dt>Dilvery Option:</dt>
                <dd>{{ $product->delivery_option ?? 'Null' }}</dd>

                <dt>Country:</dt>
                <dd>{{ $product->country->name ?? 'Null' }}</dd>


                <dt>Seller Name:</dt>
                <dd>{{ $product->seller->name ?? 'Null' }}&nbsp;{{ $product->seller->surname ?? '' }}</dd>
                <dt>Seller Email:</dt>
                <dd>{{ $product->seller->email ?? 'Null' }}</dd>
                <dt>Seller Phone No</dt>
                <dd>{{ $product->seller->phone_number ?? 'Null' }}</dd>

            </dl>
            <a class="btn btn-secondary my-2" href="{{ route('admin.showproducts')}}">Back</a>
        </div>
    </div>


</div>
@endsection
