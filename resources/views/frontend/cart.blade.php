@extends('layouts.user')

@section('content')
    <div class="container">
        <div class="card shadow p-3">
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
                    @foreach ($carts->values() as $key => $cart)
                        <tr id="row_{{ $key }}">
                            <td>{{ $cart->product->id }}</td>
                            <td>{{ $cart->product->product_name }}</td>
                            <td><img data-fancybox src="{{ asset('images/' . $cart->product->product_image) }}"
                                    alt="product_image" height="50px"></td>
                            <td><input class="form-control" disabled id="price{{ $cart->product->id }}"
                                    name="price{{ $cart->product->id }}" value="{{ $cart->product->price }}"></td>
                            <td class="text-center">
                                <button class="btn btn-outline-primary" type="button"
                                    onclick="increment('{{ $cart->product->id }}', {{ $cart->product->price }})">+</button>
                            </td>
                            <td class="text-center"><input class="form-control" disabled
                                    id="quantity{{ $cart->product->id }}" name="quantity{{ $cart->product->id }}"
                                    value="{{ $cart->quantity }}"></td>
                            <td class="text-center">
                                <button class="btn btn-outline-primary" type="button"
                                    onclick="decrement('{{ $cart->product->id }}', {{ $cart->product->price }})">-</button>
                            </td>
                            <td class="text-center"><input class="form-control cart-price" disabled
                                    id="total{{ $cart->product->id }}" name="total{{ $cart->product->id }}"
                                    value="{{ $cart->quantity * $cart->product->price }}"></td>
                            <td class="text-center">
                                <button class="btn btn-outline-primary" type="button"
                                    onclick="remove('{{ $cart->product->id }}')">X</button>
                            </td>
                        </tr>
                    @endforeach
                    @if ($carts->count() > 0)
                        <form action="{{ route('cart.checkout') }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <tr class="border shadow">
                                <td colspan="3">
                                    <label for="address">Delivery Destination :</label>
                                    <textarea class="form-control" name="address" id="address" rows="2" required></textarea>
                                </td>
                                <td colspan="2">
                                    <label for="address">Tel :</label>
                                    <input class="form-control" type="text" name="tel" id="tel" required>
                                </td>
                                <td colspan="2">
                                    <label class="text-bold" for="delivery_fee">Delivery Fee: </label>
                                    <input class="form-control" type="number" step="1" min="0" value="0"
                                        id="delivery_fee" name="delivery_fee">
                                </td>
                                <td>
                                    <label class="text-bold" for="sum">Sum: </label>
                                    <input class="form-control baht" id="sum" name="sum" readonly>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-success mt-4" type="submit">Checkout</button>
                                </td>
                            </tr>
                        </form>
                    @endif
                </tbody>
            </table>
        </div>
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
                        $(`#quantity${product_id}`).val(response.quantity);
                        $(`#total${product_id}`).val(response.quantity * price);
                        calculateSum();
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
                        if (response.quantity <= 0) {
                            location.reload();
                        }
                        $(`#quantity${product_id}`).val(response.quantity);
                        $(`#total${product_id}`).val(response.quantity * price);
                        calculateSum();
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
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Delete cart item successfully!',
                            confirmButtonText: 'OK.',
                        }).then((result) => {
                            location.reload();
                        })
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
                final_price += parseInt($(`#${el.id}`).val())
            })
            sum.val(final_price);
            renderBaht();
        }

        $(document).ready(() => {
            calculateSum();
        });
    </script>
@endsection
