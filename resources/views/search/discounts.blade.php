@extends('layouts.app')

@section('title', 'بحث التخفيضات')

@section('content')
<div class="container py-4">
    <h2 class="mb-4"><i class="fas fa-search me-2"></i>بحث التخفيضات</h2>
    
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('search.discounts') }}" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="q" class="form-control" placeholder="ابحث عن تخفيض..." value="{{ $query ?? '' }}">
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
                    <input type="number" name="min_discount" class="form-control" placeholder="أقل تخفيض %" value="{{ $minDiscount ?? '' }}">
                </div>
                <div class="col-md-2">
                    <input type="number" name="max_discount" class="form-control" placeholder="أقصى تخفيض %" value="{{ $maxDiscount ?? '' }}">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="row">
        @forelse($discounts as $discount)
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <h6>{{ $discount->title }}</h6>
                            <span class="badge bg-success fs-6">{{ $discount->percentage }}%</span>
                        </div>
                        <p class="small text-muted">{{ Str::limit($discount->description, 80) }}</p>
                        <div class="mt-2">
                            <small class="text-muted">
                                <i class="fas fa-box me-1"></i>{{ $discount->product->name ?? '' }}
                            </small>
                            <br>
                            <small class="text-muted">
                                <i class="fas fa-store me-1"></i>{{ $discount->merchant->name ?? '' }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center py-5">
                    <i class="fas fa-search fa-3x d-block mb-3"></i>
                    <h5>لم يتم العثور على تخفيضات مطابقة</h5>
                </div>
            </div>
        @endforelse
    </div>
    
    <div class="d-flex justify-content-center mt-4">
        {{ $discounts->appends(request()->query())->links() }}
    </div>
</div>
@endsection
