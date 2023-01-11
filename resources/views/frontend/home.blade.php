@extends('layouts.user')

@section('content')
    @php
        use App\Models\Product;
        $products = Product::all();
    @endphp
    <div class="row m-0 p-3">
        @foreach ($products as $product)
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 p-3">
                <div class="card h-100">
                    <div class="text-center m-3">
                        <a href="{{ asset('images/' . $product->product_image) }}" data-fancybox="products">
                            <img class="card-img-top" src="{{ asset('images/' . $product->product_image) }}"
                                alt="{{ $product->id }}"
                                style="object-fit: cover;width:auto!important;height:200px!important;max-width:100%;">
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name_price }}</h5>
                        <p class="card-text">{{ $product->product_description }}</p>
                        <form action="{{ route('cart.store') }}" method="post">
                            @csrf
                            <input type="hidden" name='product_id' value="{{$product->id}}">
                            <div class="text-right">
                                <button type="submit" class="btn btn-outline-info">Add cart</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
