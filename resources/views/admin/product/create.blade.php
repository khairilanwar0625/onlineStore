@extends('layouts.admin')
@section('title', $viewData["title"])
@section('content')
<div class="card">
    <div class="card-header fw-bold">Create New Product</div>
    <div class="card-body">
        @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        @endif
        <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input name="name" value="{{ old('name') }}" type="text" class="form-control" placeholder="Product name">
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input name="price" value="{{ old('price') }}" type="number" step="0.01" min="0" class="form-control" placeholder="0.00" onwheel="this.blur()">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" rows="3" class="form-control" placeholder="Product description">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Image URL</label>
                <input name="image_url" value="{{ old('image_url') }}" type="text"
                       class="form-control" placeholder="https://example.com/image.jpg">
                <small class="text-muted">Masukkan URL gambar dari internet</small>
            </div>
            <div class="mb-3">
                <label class="form-label">atau Upload File Gambar</label>
                <input name="image" type="file" class="form-control" accept="image/png, image/jpeg, image/jpg">
                <small class="text-muted">Upload file (hanya untuk local, tidak berfungsi di Vercel)</small>
            </div>
            <button type="submit" class="btn btn-primary">Save Product</button>
            <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection