@extends('layouts.user')
@section('content')

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="in-progress-tab" data-bs-toggle="tab" data-bs-target="#in-progress-tab-pane" type="button" role="tab" aria-controls="in-progress-tab-pane" aria-selected="true">In Progress</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="accept-tab" data-bs-toggle="tab" data-bs-target="#accept-tab-pane" type="button" role="tab" aria-controls="accept-tab-pane" aria-selected="false">Accept</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="reject-tab" data-bs-toggle="tab" data-bs-target="#reject-tab-pane" type="button" role="tab" aria-controls="reject-tab-pane" aria-selected="false">Reject</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="cancel-tab" data-bs-toggle="tab" data-bs-target="#cancel-tab-pane" type="button" role="tab" aria-controls="cancel-tab-pane" aria-selected="false">Cancel</button>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="in-progress-tab-pane" role="tabpanel" aria-labelledby="in-progress-tab" tabindex="0">
        @foreach (Auth::user()->ordersInProgress as $order)
        <div class="card p-3">
            {{ $order->order_no }}
            @foreach ($order->orderDetails as $item)
            {{ $item->product->product_name }}
            @endforeach
        </div>
        @endforeach
    </div>
    <div class="tab-pane fade" id="accept-tab-pane" role="tabpanel" aria-labelledby="accept-tab" tabindex="0">...</div>
    <div class="tab-pane fade" id="reject-tab-pane" role="tabpanel" aria-labelledby="reject-tab" tabindex="0">...</div>
    <div class="tab-pane fade" id="cancel-tab-pane" role="tabpanel" aria-labelledby="cancel-tab" tabindex="0">...</div>
  </div>

@endsection
