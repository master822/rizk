@extends('layouts.app')

@section('title', 'بحث الخدمات')

@section('content')
<div class="container py-4">
    <h2 class="mb-4"><i class="fas fa-search me-2"></i>بحث الخدمات</h2>
    
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('search.services') }}" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="q" class="form-control" placeholder="ابحث عن خدمة..." value="{{ $query ?? '' }}">
                </div>
                <div class="col-md-3">
                    <select name="service_type" class="form-select">
                        <option value="">جميع الخدمات</option>
                        <option value="cooking" {{ ($serviceType ?? '') == 'cooking' ? 'selected' : '' }}>طبخ منزل</option>
                        <option value="vegetables" {{ ($serviceType ?? '') == 'vegetables' ? 'selected' : '' }}>خضار مقطعة</option>
                        <option value="transport" {{ ($serviceType ?? '') == 'transport' ? 'selected' : '' }}>سيارة نقل</option>
                        <option value="jobs" {{ ($serviceType ?? '') == 'jobs' ? 'selected' : '' }}>فرص عمل</option>
                        <option value="hire-worker" {{ ($serviceType ?? '') == 'hire-worker' ? 'selected' : '' }}>استأجر عامل</option>
                        <option value="hire-technician" {{ ($serviceType ?? '') == 'hire-technician' ? 'selected' : '' }}>استأجر فني</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="city" class="form-select">
                        <option value="">جميع المدن</option>
                        @foreach($cities as $cityName)
                            <option value="{{ $cityName }}" {{ ($city ?? '') == $cityName ? 'selected' : '' }}>
                                {{ $cityName }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="sort" class="form-select">
                        <option value="latest" {{ ($sort ?? '') == 'latest' ? 'selected' : '' }}>الأحدث</option>
                        <option value="price_low" {{ ($sort ?? '') == 'price_low' ? 'selected' : '' }}>السعر: منخفض</option>
                        <option value="price_high" {{ ($sort ?? '') == 'price_high' ? 'selected' : '' }}>السعر: مرتفع</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="row">
        @forelse($services as $service)
            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm">
                    <img src="{{ $service->image }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="{{ $service->name }}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <h6>{{ $service->name }}</h6>
                            @if($service->rating > 0)
                                <span class="badge bg-warning">
                                    <i class="fas fa-star text-white me-1"></i>{{ $service->rating }}
                                </span>
                            @endif
                        </div>
                        <p class="small text-muted">{{ Str::limit($service->description, 60) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-primary">
                                @if($service->price > 0)
                                    {{ number_format($service->price, 2) }} $
                                @else
                                    مجاني
                                @endif
                            </span>
                            <small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i>{{ $service->city }}</small>
                        </div>
                        <small class="text-muted"><i class="fas fa-user me-1"></i>{{ $service->user->name ?? '' }}</small>
                    </div>
                    <div class="card-footer bg-transparent">
                        <a href="#" class="btn btn-sm btn-outline-primary w-100">طلب الخدمة</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center py-5">
                    <i class="fas fa-search fa-3x d-block mb-3"></i>
                    <h5>لم يتم العثور على خدمات مطابقة</h5>
                    <p class="text-muted">حاول تغيير كلمات البحث أو الفلتر</p>
                </div>
            </div>
        @endforelse
    </div>
    
    @if($services->count() > 0)
        <div class="d-flex justify-content-center mt-4">
            {{ $services->links() }}
        </div>
    @endif
</div>
@endsection
