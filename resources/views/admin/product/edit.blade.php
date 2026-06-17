 @extends('layouts.admin')
@section('title', $viewData["title"])
@section('content')
<div class="card">
    <div class="card-header fw-bold">Edit Product: {{ $viewData["product"]->getName() }}</div>
    <div class="card-body">
        @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        @endif
        <form method="POST" action="{{ route('admin.product.update', $viewData["product"]->getId()) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input name="name" value="{{ $viewData["product"]->getName() }}" type="text" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input name="price" value="{{ $viewData["product"]->getPrice() }}" type="number" step="0.01" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" rows="3" class="form-control">{{ $viewData["product"]->getDescription() }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Image (kosongkan jika tidak ingin ganti)</label>
                <input name="image" type="file" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
            <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
