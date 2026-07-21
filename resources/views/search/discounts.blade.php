@extends('layouts.app')

@section('title', 'بحث التخفيضات')

@section('content')
<div class="container py-4">
    <h2 class="section-title-rizk mb-4">🔍 بحث التخفيضات</h2>
    
    <div class="card-rizk p-4 mb-4">
        <form action="{{ route('search.discounts') }}" method="GET">
            <div class="row g-3">
                <div class="col-md-4">
                    <label style="color: var(--text-primary);">كلمة البحث</label>
                    <input type="text" name="q" class="form-control form-rizk" placeholder="ابحث عن تخفيض..." value="{{ request('q') }}">
                </div>
                <div class="col-md-2">
                    <label style="color: var(--text-primary);">نسبة التخفيض من</label>
                    <input type="number" name="min_discount" class="form-control form-rizk" placeholder="0" value="{{ request('min_discount') }}">
                </div>
                <div class="col-md-2">
                    <label style="color: var(--text-primary);">نسبة التخفيض إلى</label>
                    <input type="number" name="max_discount" class="form-control form-rizk" placeholder="100" value="{{ request('max_discount') }}">
                </div>
                <div class="col-md-2">
                    <label style="color: var(--text-primary);">الترتيب</label>
                    <select name="sort" class="form-select form-rizk">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>الأحدث</option>
                        <option value="discount_high" {{ request('sort') == 'discount_high' ? 'selected' : '' }}>أعلى تخفيض</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label style="color: var(--text-primary);">&nbsp;</label>
                    <button type="submit" class="btn btn-rizk-primary w-100">
                        <i class="fas fa-search me-2"></i>بحث
                    </button>
                </div>
            </div>
        </form>
    </div>
    
    <div class="row g-4">
        @forelse($discounts as $discount)
            <div class="col-md-4">
                <div class="card-rizk p-3">
                    <div class="d-flex justify-content-between">
                        <h6 style="color: var(--text-primary);">{{ $discount->name }}</h6>
                        <span class="badge-rizk badge-rizk-gold">{{ $discount->percentage }}%</span>
                    </div>
                    <p class="small text-muted">{{ Str::limit($discount->description, 80) }}</p>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">{{ $discount->is_active ? 'نشط' : 'غير نشط' }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-tag fa-3x gold-text mb-3"></i>
                <h5 style="color: var(--text-primary);">لا توجد تخفيضات</h5>
            </div>
        @endforelse
    </div>
    
    @if($discounts->hasPages())
        <div class="pagination-simple">
            {{ $discounts->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
