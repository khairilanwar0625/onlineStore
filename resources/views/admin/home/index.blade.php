 @extends('layouts.admin')
@section('title', $viewData["title"])
@section('content')
<div class="card">
    <div class="card-header fw-bold">Admin Panel - Home</div>
    <div class="card-body">
        <p>Welcome to the Admin Panel!</p>
        <a href="{{ route('admin.product.index') }}" class="btn btn-primary">Manage Products</a>
    </div>
</div>
@endsection
