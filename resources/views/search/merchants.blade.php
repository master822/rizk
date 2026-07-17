@extends('layouts.app')

@section('title', 'بحث التجار')

@section('content')
<div class="container py-4">
    <h2 class="mb-4"><i class="fas fa-search me-2"></i>بحث التجار</h2>
    
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('search.merchants') }}" class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="q" class="form-control" placeholder="ابحث عن تاجر..." value="{{ $query ?? '' }}">
                </div>
                <div class="col-md-4">
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
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i> بحث</button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="row">
        @forelse($merchants as $merchant)
            <div class="col-md-3 mb-3">
                <div class="card h-100 shadow-sm text-center p-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($merchant->name) }}&size=80" class="rounded-circle mx-auto mb-3" style="width: 80px; height: 80px;">
                    <h6>{{ $merchant->name }}</h6>
                    @if($merchant->store_name)
                        <small class="text-muted">{{ $merchant->store_name }}</small>
                    @endif
                    <p class="small text-muted">{{ $merchant->city ?? '' }}</p>
                    <div class="mt-2">
                        <span class="badge bg-primary">عدد المنتجات: {{ $merchant->products->count() }}</span>
                    </div>
                    <a href="{{ route('merchants.show', $merchant->id) }}" class="btn btn-sm btn-outline-primary mt-2">عرض المتجر</a>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center py-5">
                    <i class="fas fa-search fa-3x d-block mb-3"></i>
                    <h5>لم يتم العثور على تجار مطابقين</h5>
                </div>
            </div>
        @endforelse
    </div>
    
    <div class="d-flex justify-content-center mt-4">
        {{ $merchants->appends(request()->query())->links() }}
    </div>
</div>
@endsection
