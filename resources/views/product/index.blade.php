@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="row">
    @forelse($viewData["products"] as $product)
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <img src="{{ asset('uploads/' . $product->getImage()) }}"
                 class="card-img-top img-card"
                 onerror="this.src='https://via.placeholder.com/300x200'">
            <div class="card-body p-4">
                <div class="text-center">
                    <h5 class="fw-bolder">{{ $product->getName() }}</h5>
                    $ {{ $product->getPrice() }}
                </div>
            </div>
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center">
                    <a href="{{ route('product.show', $product->getId()) }}"
                       class="btn btn-outline-dark mt-auto">View Product</a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-info">No products available yet.</div>
    </div>
    @endforelse
</div>
@endsection