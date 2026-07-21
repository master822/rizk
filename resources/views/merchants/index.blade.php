@extends('layouts.app')

@section('title', 'جميع التجار')

@section('content')
<div class="container py-4">
    <h1 class="section-title-rizk text-center mb-4">جميع التجار</h1>
    
    <div class="row g-4">
        @forelse($merchants as $merchant)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card-rizk hover-lift text-center p-3">
                    <div class="merchant-avatar mb-3">
                        @if($merchant->avatar)
                            <img src="{{ asset('storage/' . $merchant->avatar) }}" 
                                 class="rounded-circle" 
                                 width="80" height="80" 
                                 style="object-fit: cover; border: 3px solid var(--primary-color);">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($merchant->store_name ?? $merchant->name) }}&size=80&background=d4af37&color=fff" 
                                 class="rounded-circle" 
                                 width="80" height="80">
                        @endif
                    </div>
                    <h5 class="merchant-name" style="color: var(--text-primary);">
                        {{ $merchant->store_name ?? $merchant->name }}
                    </h5>
                    <p class="merchant-category text-muted mb-2">
                        <i class="fas fa-tag me-1"></i>
                        {{ $merchant->getCategoryName($merchant->store_category) }}
                    </p>
                    <div class="merchant-info">
                        <div class="rating-stars mb-2">
                            @php
                                $avgRating = $merchant->ratings->avg('rating') ?? 0;
                                $fullStars = floor($avgRating);
                                $halfStar = $avgRating - $fullStars >= 0.5;
                            @endphp
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $fullStars)
                                    <i class="fas fa-star text-warning"></i>
                                @elseif($i == $fullStars + 1 && $halfStar)
                                    <i class="fas fa-star-half-alt text-warning"></i>
                                @else
                                    <i class="far fa-star text-muted"></i>
                                @endif
                            @endfor
                            <span class="text-muted small">({{ $merchant->ratings->count() }})</span>
                        </div>
                        <p class="text-muted small mb-0">
                            <i class="fas fa-box me-1"></i>
                            {{ $merchant->products_count ?? 0 }} منتج
                        </p>
                    </div>
                    <a href="{{ route('merchants.show', $merchant->id) }}" 
                       class="btn btn-rizk-primary btn-sm mt-3 w-100">
                        زيارة المتجر
                    </a>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-store fa-3x gold-text mb-3"></i>
                <h5 style="color: var(--text-primary);">لا يوجد تجار حالياً</h5>
                <p style="color: var(--text-muted);">سجل كتاجر وابدأ ببيع منتجاتك!</p>
            </div>
        @endforelse
    </div>
    
    @if($merchants->hasPages())
        <div class="pagination-container">
            {{ $merchants->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
