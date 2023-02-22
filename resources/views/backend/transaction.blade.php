@extends('layouts.app')

@section('content')
    <div class="container p-3">
        <table class="table table-bordered" style="table-layout: fixed;">
            <thead>
                <tr>
                    <th style="width: 200px;">slip</th>
                    <th>detail</th>
                    <th>action</th>
                </tr>
            </thead>
            @foreach ($orders as $order)
                <tr>
                    <td>
                        <a href="{{ asset('images/slip/' . $order->slip) }}" data-fancybox="images_{{ $order->id }}">
                            <img src="{{ asset('images/slip/' . $order->slip) }}" alt="" width="100%">
                        </a>
                    </td>
                    <td>
                        {{ $order->order_no }} {!! $order->status == 'in progress'
                            ? "<span class='text-warning'>(In Progress)</span>"
                            : ($order->status == 'approve'
                                ? "<span class='text-success'>(Approve)</span>"
                                : ($order->status == 'reject'
                                    ? "<span class='text-danger'>(Reject)</span>"
                                    : "<span class='text-secondary'>(Cancel)</span>")) !!} <br />
                        @php
                            $total = 0;
                        @endphp
                        <table class="table table-borderless">
                            @foreach ($order->orderDetails as $key => $orderDetail)
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    <td style="text-align: left">{{ $orderDetail->product->product_name }} x
                                        {{ $orderDetail->quantity }}</td>
                                    <td style="text-align: right;">
                                        {{ number_format($orderDetail->product->price * $orderDetail->quantity, 2) }}
                                    </td>
                                    <td>บาท</td>
                                </tr>
                                @php
                                    $total += $orderDetail->product->price * $orderDetail->quantity;
                                @endphp
                            @endforeach
                            <tr>
                                <td colspan="2"> ราคารวม</td>
                                <td style="text-align: right;">{{ number_format($total, 2) }}</td>
                                <td>บาท</td>
                            </tr>
                        </table>
                        ที่อยู่ <br>
                        {{ $order->address }}<br />
                        เบอร์โทร <br>
                        {{ $order->tel }}<br />
                    </td>
                    <td>
                        @if ($order->status == 'in progress')
                            <a href="{{ route('transaction.approve', ['order' => $order->id]) }}"
                                class="btn btn-success form-control">Approve</a>
                            <a href="{{ route('transaction.reject', ['order' => $order->id]) }}"
                                class="btn btn-danger form-control">Reject</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
