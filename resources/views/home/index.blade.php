@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', 'Welcome to our store!')
@section('content')
<div class="row">
    <div class="col-lg-6 ms-auto">
        <p class="lead">
            Welcome to Online Store! Browse our products and find what you need.
        </p>
        <a href="{{ route('product.index') }}" class="btn btn-primary btn-lg">
            Shop Now
        </a>
    </div>
</div>
@endsection