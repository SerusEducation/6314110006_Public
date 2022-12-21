@extends('layouts.app')

@section('content')
<a href="{{ route('product.create') }}" class="btn btn-primary m-3">Add Product</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Product Image</th>
            <th>Price</th>
            <th>Product Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{$product->product_name}}</td>
            <td><img src="{{ asset( 'images/' . $product->product_image) }}" alt="product_image" height="50px"></td>
            <td>{{$product->price}}</td>
            <td>{{$product->product_description}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
