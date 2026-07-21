@extends('layouts.app')

@section('title', 'الخدمات - Rizk')

@section('content')
<div class="container py-4">
    <h1 class="section-title-rizk text-center mb-4">جميع الخدمات</h1>
    
    <div class="row g-4">
        <div class="col-md-4 col-sm-6">
            <a href="{{ url('/services/cooking') }}" class="text-decoration-none">
                <div class="card-rizk text-center p-4 hover-lift">
                    <div class="brand-icon mx-auto mb-3" style="width: 70px; height: 70px; font-size: 2rem; background: linear-gradient(135deg, #f59e0b, #d97706);">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h5 style="color: var(--text-primary);">طبخ منزل</h5>
                    <p class="small text-muted">أشهى الأطباق المنزلية بلمسة سورية أصيلة</p>
                </div>
            </a>
        </div>
        
        <div class="col-md-4 col-sm-6">
            <a href="{{ url('/services/vegetables') }}" class="text-decoration-none">
                <div class="card-rizk text-center p-4 hover-lift">
                    <div class="brand-icon mx-auto mb-3" style="width: 70px; height: 70px; font-size: 2rem; background: linear-gradient(135deg, #22c55e, #16a34a);">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h5 style="color: var(--text-primary);">تجهيز خضار</h5>
                    <p class="small text-muted">خضار طازجة مقطعة وجاهزة للطبخ</p>
                </div>
            </a>
        </div>
        
        <div class="col-md-4 col-sm-6">
            <a href="{{ url('/services/transport') }}" class="text-decoration-none">
                <div class="card-rizk text-center p-4 hover-lift">
                    <div class="brand-icon mx-auto mb-3" style="width: 70px; height: 70px; font-size: 2rem; background: linear-gradient(135deg, #3b82f6, #2563eb);">
                        <i class="fas fa-truck"></i>
                    </div>
                    <h5 style="color: var(--text-primary);">سيارة نقل</h5>
                    <p class="small text-muted">خدمات نقل سريعة وآمنة</p>
                </div>
            </a>
        </div>
        
        <div class="col-md-4 col-sm-6">
            <a href="{{ url('/services/jobs') }}" class="text-decoration-none">
                <div class="card-rizk text-center p-4 hover-lift">
                    <div class="brand-icon mx-auto mb-3" style="width: 70px; height: 70px; font-size: 2rem; background: linear-gradient(135deg, #06b6d4, #0891b2);">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h5 style="color: var(--text-primary);">فرص عمل</h5>
                    <p class="small text-muted">أفضل فرص العمل في مختلف المجالات</p>
                </div>
            </a>
        </div>
        
        <div class="col-md-4 col-sm-6">
            <a href="{{ url('/services/hire-worker') }}" class="text-decoration-none">
                <div class="card-rizk text-center p-4 hover-lift">
                    <div class="brand-icon mx-auto mb-3" style="width: 70px; height: 70px; font-size: 2rem; background: linear-gradient(135deg, #64748b, #475569);">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h5 style="color: var(--text-primary);">استأجر عامل</h5>
                    <p class="small text-muted">أفضل العمال المهرة بأسعار تنافسية</p>
                </div>
            </a>
        </div>
        
        <div class="col-md-4 col-sm-6">
            <a href="{{ url('/services/hire-technician') }}" class="text-decoration-none">
                <div class="card-rizk text-center p-4 hover-lift">
                    <div class="brand-icon mx-auto mb-3" style="width: 70px; height: 70px; font-size: 2rem; background: linear-gradient(135deg, #ef4444, #dc2626);">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h5 style="color: var(--text-primary);">استأجر فني</h5>
                    <p class="small text-muted">فنيين متخصصين مع ضمان الجودة</p>
                </div>
            </a>
        </div>
        
        <div class="col-md-4 col-sm-6">
            <a href="{{ url('/services/cleaning-company') }}" class="text-decoration-none">
                <div class="card-rizk text-center p-4 hover-lift">
                    <div class="brand-icon mx-auto mb-3" style="width: 70px; height: 70px; font-size: 2rem; background: linear-gradient(135deg, #8b5cf6, #6d28d9);">
                        <i class="fas fa-broom"></i>
                    </div>
                    <h5 style="color: var(--text-primary);">ورشة تنظيف</h5>
                    <p class="small text-muted">خدمات تنظيف احترافية بجودة عالية</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
