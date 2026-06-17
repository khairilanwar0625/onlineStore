 @extends('layouts.admin')
@section('title', $viewData["title"])
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span class="fw-bold">All Products</span>
        <a href="{{ route('admin.product.create') }}" class="btn btn-sm btn-primary">+ Add Product</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($viewData["products"] as $product)
                <tr>
                    <td>{{ $product->getId() }}</td>
                    <td>{{ $product->getName() }}</td>
                    <td>${{ $product->getPrice() }}</td>
                    <td>
                        <a href="{{ route('admin.product.edit', $product->getId()) }}"
                           class="btn btn-sm btn-warning">Edit</a>
                    </td>
                    <td>
                        <a href="{{ route('admin.product.delete', $product->getId()) }}"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Delete?')">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
