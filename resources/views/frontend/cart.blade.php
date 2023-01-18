@extends('layouts.user')

@section('content')
<div class="container">
    <table class="table table-striped" style="table-layout: fixed">
        <thead>
            <tr>
                <th>#</th>
                <th >Product Name</th>
                <th>Product Image</th>
                <th>Price</th>
                <th colspan="3" class="text-center" style="width: 200px;">Quantity</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carts as $cart)
            <tr>
                <td>{{ $cart->product->id }}</td>
                <td>{{$cart->product->product_name}}</td>
                <td><img data-fancybox src="{{ asset( 'images/' . $cart->product->product_image) }}" alt="product_image" height="50px"></td>
                <td>{{$cart->product->price}}</td>
                <td class="text-center">
                    <form action="{{route('cart.increment',$cart->id)}}" method="post">
                        @method('PUT')
                        @csrf
                        <button class="btn btn-outline-primary" type="submit">+</button>
                    </form>
                </td>
                <td class="text-center">{{$cart->quantity}}</td>
                <td class="text-center">
                    <form action="{{route('cart.decrement',$cart->id)}}" method="post">
                        @method('PUT')
                        @csrf
                        <button class="btn btn-outline-primary" type="submit">-</button>
                    </form>
                </td>
                <td class="text-center">
                    <form action="{{route('cart.destroy',$cart->id)}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-outline-primary" type="submit">X</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
