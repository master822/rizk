@extends('layouts.app')

@section('title', 'بحث المنتجات المستعملة')

@section('content')
<div class="container py-4">
    <h2 class="mb-4"><i class="fas fa-search me-2"></i>بحث المنتجات المستعملة</h2>
    
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('search.used-products') }}" class="row g-3">
                <div class="col-md-5">
                    <input type="text" name="q" class="form-control" placeholder="ابحث عن منتج مستعمل..." value="{{ $query ?? '' }}">
                </div>
                <div class="col-md-3">
                    <select name="category" class="form-select">
                        <option value="">جميع الفئات</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ ($category ?? '') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" name="min_price" class="form-control" placeholder="أقل سعر" value="{{ $minPrice ?? '' }}">
                </div>
                <div class="col-md-1">
                    <input type="number" name="max_price" class="form-control" placeholder="أعلى سعر" value="{{ $maxPrice ?? '' }}">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-3 mb-3">
                <div class="card h-100 shadow-sm">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" style="height: 150px; object-fit: cover;" alt="{{ $product->name }}">
                    @else
                        <img src="https://via.placeholder.com/300x150/22c55e/ffffff?text=مستعمل" class="card-img-top" style="height: 150px; object-fit: cover;" alt="{{ $product->name }}">
                    @endif
                    <div class="card-body">
                        <h6 class="card-title">{{ $product->name }}</h6>
                        <p class="card-text small text-muted">{{ Str::limit($product->description, 50) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-primary">{{ number_format($product->price, 2) }} $</span>
                            <span class="badge bg-warning">مستعمل</span>
                        </div>
                        <small class="text-muted"><i class="fas fa-user me-1"></i>{{ $product->user->name ?? '' }}</small>
                    </div>
                    <div class="card-footer bg-transparent">
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-outline-primary w-100">عرض التفاصيل</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center py-5">
                    <i class="fas fa-search fa-3x d-block mb-3"></i>
                    <h5>لم يتم العثور على منتجات مستعملة مطابقة</h5>
                </div>
            </div>
        @endforelse
    </div>
    
    <div class="d-flex justify-content-center mt-4">
        {{ $products->appends(request()->query())->links() }}
    </div>
</div>
@endsection
