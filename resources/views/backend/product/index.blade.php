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
            <th colspan="2" class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{$product->product_name}}</td>
            <td><img data-fancybox src="{{ asset( 'images/' . $product->product_image) }}" alt="product_image" height="50px"></td>
            <td>{{$product->price}}</td>
            <td>{{$product->product_description}}</td>
            <td class="text-center">
                <a href="{{route('product.edit',$product->id)}}">
                    <button class="btn btn-warning text-white" type="button">Edit</button>
                </a>
            </td>
            <td class="text-center">
                <form action="{{route('product.destroy',$product->id)}}" method="post">
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
