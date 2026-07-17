@extends('layouts.app')

@section('title', 'Rizk - الرئيسية')

@section('content')
<div class="container py-4">
    <!-- Hero Section -->
    <div class="row animate-fade-up">
        <div class="col-12">
            <div class="card-rizk card-rizk-gold p-4 p-md-5 text-center" style="background: var(--bg-card); border: 2px solid rgba(212, 175, 55, 0.2);">
                <div class="row align-items-center">
                    <div class="col-lg-8 mx-auto">
                        <div class="mb-3">
                            <span class="badge-rizk badge-rizk-gold">
                                <i class="fas fa-gem me-1"></i> مرحباً بك في Rizk
                            </span>
                        </div>
                        <h1 class="display-4 fw-bold mb-3">
                            <span class="gold-gradient-text">Rizk</span>
                            <span style="color: var(--text-primary);"> - رزق</span>
                        </h1>
                        <p class="lead" style="color: var(--text-secondary);">
                            منصة شاملة للبيع والشراء مع أفضل العروض والتخفيضات
                        </p>
                        <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
                            <a href="{{ url('/products') }}" class="btn btn-rizk-primary">
                                <i class="fas fa-shopping-bag me-2"></i>تسوق الآن
                            </a>
                            <a href="{{ url('/merchants') }}" class="btn btn-rizk-outline">
                                <i class="fas fa-store me-2"></i>استكشف التجار
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- الأقسام السريعة -->
    <div class="row g-3 mt-4">
        <div class="col-md-3 col-6 animate-fade-up delay-1">
            <a href="{{ url('/products') }}" class="text-decoration-none">
                <div class="card-rizk text-center p-3 hover-scale">
                    <div class="brand-icon mx-auto mb-2" style="width: 50px; height: 50px; font-size: 1.3rem;">
                        <i class="fas fa-box"></i>
                    </div>
                    <h6 style="color: var(--text-primary); font-weight: 700;">المنتجات</h6>
                    <small style="color: var(--text-muted);">تسوق أحدث المنتجات</small>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-6 animate-fade-up delay-2">
            <a href="{{ url('/merchants') }}" class="text-decoration-none">
                <div class="card-rizk text-center p-3 hover-scale">
                    <div class="brand-icon mx-auto mb-2" style="width: 50px; height: 50px; font-size: 1.3rem; background: linear-gradient(135deg, var(--secondary-color), var(--secondary-dark));">
                        <i class="fas fa-store"></i>
                    </div>
                    <h6 style="color: var(--text-primary); font-weight: 700;">التجار</h6>
                    <small style="color: var(--text-muted);">تعرف على أفضل التجار</small>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-6 animate-fade-up delay-3">
            <a href="{{ url('/discounts') }}" class="text-decoration-none">
                <div class="card-rizk text-center p-3 hover-scale">
                    <div class="brand-icon mx-auto mb-2" style="width: 50px; height: 50px; font-size: 1.3rem; background: linear-gradient(135deg, var(--success-color), var(--success-dark));">
                        <i class="fas fa-tag"></i>
                    </div>
                    <h6 style="color: var(--text-primary); font-weight: 700;">التخفيضات</h6>
                    <small style="color: var(--text-muted);">أفضل العروض الحصرية</small>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-6 animate-fade-up delay-4">
            <a href="{{ url('/services') }}" class="text-decoration-none">
                <div class="card-rizk text-center p-3 hover-scale">
                    <div class="brand-icon mx-auto mb-2" style="width: 50px; height: 50px; font-size: 1.3rem; background: linear-gradient(135deg, var(--info-color), var(--info-dark));">
                        <i class="fas fa-concierge-bell"></i>
                    </div>
                    <h6 style="color: var(--text-primary); font-weight: 700;">الخدمات</h6>
                    <small style="color: var(--text-muted);">خدمات متنوعة لك</small>
                </div>
            </a>
        </div>
    </div>

    <!-- أحدث المنتجات -->
    <div class="mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="section-title-rizk" style="color: var(--text-primary); margin-bottom: 0;">
                <i class="fas fa-star gold-text me-2"></i>أحدث المنتجات
            </h3>
            <a href="{{ url('/products') }}" class="btn btn-rizk-outline btn-sm">عرض الكل <i class="fas fa-arrow-left me-1"></i></a>
        </div>
        <div class="row g-3">
            @php
                $products = \App\Models\Product::latest()->take(8)->get();
            @endphp
            @forelse($products as $product)
                <div class="col-lg-3 col-md-4 col-6 animate-fade-up delay-{{ $loop->iteration % 4 + 1 }}">
                    <div class="card-rizk hover-lift">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="{{ $product->name }}">
                        @else
                            <img src="https://via.placeholder.com/300x180/1e293b/d4af37?text={{ urlencode($product->name ?? 'Rizk') }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="{{ $product->name ?? '' }}">
                        @endif
                        <div class="card-body">
                            <h6 class="card-title" style="color: var(--text-primary); font-weight: 700;">{{ $product->name ?? 'منتج' }}</h6>
                            <p class="card-text small" style="color: var(--text-muted);">{{ Str::limit($product->description ?? '', 40) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold gold-text">{{ number_format($product->price ?? 0, 2) }} $</span>
                                @if(isset($product->condition))
                                    <span class="badge-rizk badge-rizk-gold">{{ $product->condition == 'new' ? 'جديد' : 'مستعمل' }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-rizk-outline btn-sm w-100">عرض التفاصيل</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card-rizk text-center p-5">
                        <i class="fas fa-box-open fa-3x gold-text mb-3"></i>
                        <h5 style="color: var(--text-primary);">لا توجد منتجات حالياً</h5>
                        <p style="color: var(--text-muted);">سجل كتاجر وأضف منتجاتك</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- التخفيضات المميزة -->
    <div class="mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="section-title-rizk" style="color: var(--text-primary); margin-bottom: 0;">
                <i class="fas fa-tag gold-text me-2"></i>تخفيضات مميزة
            </h3>
            <a href="{{ url('/discounts') }}" class="btn btn-rizk-outline btn-sm">عرض الكل <i class="fas fa-arrow-left me-1"></i></a>
        </div>
        <div class="row g-3">
            @php
                $discounts = \App\Models\Discount::where('is_active', 1)->latest()->take(4)->get();
            @endphp
            @forelse($discounts as $discount)
                <div class="col-md-3 col-6 animate-fade-up delay-{{ $loop->iteration % 4 + 1 }}">
                    <div class="card-rizk card-rizk-gold hover-glow">
                        <div class="card-body text-center">
                            <div class="position-relative">
                                <span class="badge-rizk badge-rizk-gold" style="font-size: 1.2rem; padding: 8px 16px;">
                                    {{ $discount->percentage ?? 0 }}% <i class="fas fa-gem me-1"></i>
                                </span>
                            </div>
                            <h6 class="mt-3" style="color: var(--text-primary); font-weight: 700;">{{ $discount->title ?? 'تخفيض' }}</h6>
                            <p class="small" style="color: var(--text-muted);">{{ Str::limit($discount->description ?? '', 50) }}</p>
                            @if(isset($discount->product))
                                <small class="text-muted">
                                    <i class="fas fa-box me-1"></i>{{ $discount->product->name ?? '' }}
                                </small>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card-rizk text-center p-5">
                        <i class="fas fa-tag fa-3x gold-text mb-3"></i>
                        <h5 style="color: var(--text-primary);">لا توجد تخفيضات حالياً</h5>
                        <p style="color: var(--text-muted);">تابعنا للحصول على أفضل العروض</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- الخدمات -->
    <div class="mt-5">
        <h3 class="section-title-rizk text-center" style="color: var(--text-primary);">
            <i class="fas fa-concierge-bell gold-text me-2"></i>خدماتنا
        </h3>
        <p class="text-center" style="color: var(--text-muted);">نقدم لك مجموعة متنوعة من الخدمات لتلبية احتياجاتك</p>
        <div class="row g-3 mt-2">
            <div class="col-md-2 col-4 animate-fade-up delay-1">
                <a href="{{ url('/services/cooking') }}" class="text-decoration-none">
                    <div class="card-rizk text-center p-3 hover-scale">
                        <i class="fas fa-utensils fa-2x gold-text mb-2"></i>
                        <small style="color: var(--text-primary); font-weight: 600;">طبخ منزل</small>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-4 animate-fade-up delay-2">
                <a href="{{ url('/services/vegetables') }}" class="text-decoration-none">
                    <div class="card-rizk text-center p-3 hover-scale">
                        <i class="fas fa-leaf fa-2x gold-text mb-2"></i>
                        <small style="color: var(--text-primary); font-weight: 600;">خضار مقطعة</small>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-4 animate-fade-up delay-3">
                <a href="{{ url('/services/transport') }}" class="text-decoration-none">
                    <div class="card-rizk text-center p-3 hover-scale">
                        <i class="fas fa-truck fa-2x gold-text mb-2"></i>
                        <small style="color: var(--text-primary); font-weight: 600;">سيارة نقل</small>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-4 animate-fade-up delay-4">
                <a href="{{ url('/services/jobs') }}" class="text-decoration-none">
                    <div class="card-rizk text-center p-3 hover-scale">
                        <i class="fas fa-briefcase fa-2x gold-text mb-2"></i>
                        <small style="color: var(--text-primary); font-weight: 600;">فرص عمل</small>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-4 animate-fade-up delay-5">
                <a href="{{ url('/services/hire-worker') }}" class="text-decoration-none">
                    <div class="card-rizk text-center p-3 hover-scale">
                        <i class="fas fa-user-tie fa-2x gold-text mb-2"></i>
                        <small style="color: var(--text-primary); font-weight: 600;">استأجر عامل</small>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-4 animate-fade-up delay-3">
                <a href="{{ url('/services/hire-technician') }}" class="text-decoration-none">
                    <div class="card-rizk text-center p-3 hover-scale">
                        <i class="fas fa-tools fa-2x gold-text mb-2"></i>
                        <small style="color: var(--text-primary); font-weight: 600;">استأجر فني</small>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection