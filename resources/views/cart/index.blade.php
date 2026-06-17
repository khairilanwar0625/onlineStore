@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(empty($viewData["cart"]))
    <div class="alert alert-info">
        Your cart is empty. <a href="{{ route('product.index') }}">Shop now</a>!
    </div>
@else
<div class="card mb-4">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                @foreach($viewData["cart"] as $id => $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>$ {{ number_format($item['price'], 2) }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>$ {{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body d-flex align-items-center gap-2">
        <h5 class="mb-0">Total: $ {{ number_format($viewData["total"], 2) }}</h5>
        <div class="ms-auto">
            @auth
            <form action="{{ route('cart.purchase') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success">Purchase</button>
            </form>
            @else
            <a href="{{ route('login') }}" class="btn btn-success">Login to Purchase</a>
            @endauth

            <form action="{{ route('cart.delete') }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Clear all items from cart?')">
                @csrf
                <button type="submit" class="btn btn-danger ms-2">Clear Cart</button>
            </form>
        </div>
    </div>
</div>
@endif
@endsection