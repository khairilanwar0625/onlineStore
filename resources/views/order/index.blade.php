 @extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($viewData["orders"]->isEmpty())
    <div class="alert alert-info">You have no orders yet.</div>
@else
@foreach($viewData["orders"] as $order)
<div class="card mb-4">
    <div class="card-header">
        <strong>Order #{{ $order->getId() }}</strong> —
        {{ $order->getCreatedAt() }} —
        <strong>Total: ${{ $order->getTotal() }}</strong>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr><th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th></tr>
            </thead>
            <tbody>
                @foreach($order->getItems() as $item)
                <tr>
                    <td>{{ $item->getProduct()->getName() }}</td>
                    <td>${{ $item->getPrice() }}</td>
                    <td>{{ $item->getQuantity() }}</td>
                    <td>${{ $item->getPrice() * $item->getQuantity() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endforeach
@endif
@endsection
