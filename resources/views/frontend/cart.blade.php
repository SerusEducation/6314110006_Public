@extends('layouts.user')

@section('content')
    <div class="container">
        <table class="table table-striped" style="table-layout: fixed">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Price</th>
                    <th colspan="3" class="text-center" style="width: 200px;">Quantity</th>
                    <th>Total</th>
                    <th class="text-center">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $cart)
                    <tr>
                        <td>{{ $cart->product->id }}</td>
                        <td>{{ $cart->product->product_name }}</td>
                        <td><img data-fancybox src="{{ asset('images/' . $cart->product->product_image) }}"
                                alt="product_image" height="50px"></td>
                        <td>{{ $cart->product->price }}</td>
                        <td class="text-center">
                            <button class="btn btn-outline-primary" type="button"
                                onclick="increment('{{ $cart->product->id }}', {{$cart->product->price}})">+</button>
                        </td>
                        <td class="text-center" id="quantity{{$cart->product->id}}" name="quantity{{$cart->product->id}}">{{ $cart->quantity }}</td>
                        <td class="text-center">
                            <button class="btn btn-outline-primary" type="button"
                                onclick="decrement('{{ $cart->product->id }}', {{$cart->product->price}})">-</button>
                        </td>
                        <td class="text-center cart-price" id="total{{$cart->product->id}}" name="total{{$cart->product->id}}">{{ $cart->quantity * $cart->product->price }}</td>
                        <td class="text-center">
                            <button class="btn btn-outline-primary" type="button"
                                onclick="remove('{{ $cart->product->id }}')">X</button>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="6"></td>
                    <th>Sum: </th>
                    <td class="text-center">
                        <input type="number" id="sum" name="sum" class="form-control" disabled>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
@section('script')
    <script>
        function increment(product_id, price) {
            $.ajax({
                url: '{{ url('api/cart/increment') }}',
                method: 'GET',
                data: {
                    product_id: product_id,
                    user_id: {!! Auth::user()->id !!}
                },
                success: (response) => {
                    if (response.status == "success") {
                        alertSwal(
                        `Increment to product id ${product_id} to ${response.quantity} successfully!`);
                        $(`#quantity${product_id}`).html(response.quantity);
                        $(`#total${product_id}`).html(response.quantity * price);
                    } else {
                        alertSwal(`Increment to product id ${product_id} failed!`);
                    }
                }
            });
        }

        function decrement(product_id, price) {
            $.ajax({
                url: '{{ url('api/cart/decrement') }}',
                method: 'GET',
                data: {
                    product_id: product_id,
                    user_id: {!! Auth::user()->id !!}
                },
                success: (response) => {
                    if (response.status == "success") {
                        alertSwal(
                        `Decrement to product id ${product_id} to ${response.quantity} successfully!`);
                        $(`#quantity${product_id}`).html(response.quantity);
                        $(`#total${product_id}`).html(response.quantity * price);
                    } else {
                        alertSwal(`Decrement to product id ${product_id} failed!`);
                    }
                }
            });
        }

        function remove(product_id) {
            $.ajax({
                url: '{{ url('api/cart/destroy') }}',
                method: 'GET',
                data: {
                    product_id: product_id,
                    user_id: {!! Auth::user()->id !!}
                },
                success: (response) => {
                    if (response.status == "success") {
                        alertSwal(response.message);
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    } else {
                        alertSwal(response.message);
                    }
                }
            });
        }
        function calculateSum() {
            let sum = $('#sum');
            let final_price = 0;
            $('.cart-price').each((index, el) => {
                console.log(el.val())
                // final_price += el.text();
            })
            sum.val()
        }

        $(document).ready(() => {
            calculateSum();
        });
    </script>
@endsection