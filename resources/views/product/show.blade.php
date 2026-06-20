@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="container px-4 px-lg-5 my-5">
    <div class="row gx-4 gx-lg-5 align-items-center">
        <div class="col-md-6">
            <img src="{{ Str::startsWith($viewData['product']->getImage(), 'http') ? $viewData['product']->getImage() : asset('uploads/' . $viewData['product']->getImage()) }}"
                 class="img-fluid rounded mb-5 mb-md-0"
                 onerror="this.src='https://via.placeholder.com/500x400'">
        </div>
        <div class="col-md-6">
            <h1 class="display-5 fw-bolder">{{ $viewData["product"]->getName() }}</h1>
            <div class="fs-5 mb-5">
                <span>$ {{ $viewData["product"]->getPrice() }}</span>
            </div>
            <p class="lead">{{ $viewData["product"]->getDescription() }}</p>
            <form action="{{ route('cart.add', $viewData["product"]->getId()) }}" method="POST">
                @csrf
                <div class="d-flex align-items-center mb-3">
                    <label class="me-3 fw-bold">Quantity:</label>
                    <input type="number" name="quantity" value="1" min="1" max="100"
                           class="form-control" style="width:80px;">
                </div>
                <button type="submit" class="btn btn-outline-dark">
                    Add to Cart
                </button>
            </form>
        </div>
    </div>
</div>
@endsection