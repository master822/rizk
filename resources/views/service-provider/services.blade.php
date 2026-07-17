@extends('layouts.app')

@section('title', 'خدماتي')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="section-title-rizk">خدماتي</h4>
        <a href="{{ route('service-provider.services.create') }}" class="btn btn-rizk-primary">+ إضافة خدمة</a>
    </div>

    <div class="row g-3">
        @forelse($services as $service)
        <div class="col-md-4">
            <div class="card-rizk hover-lift">
                @if($service->images)
                    @php $images = json_decode($service->images, true); @endphp
                    @if($images && count($images) > 0)
                        <img src="{{ asset('storage/' . $images[0]) }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                    @endif
                @endif
                <div class="card-body">
                    <h6 style="color: var(--text-primary);">{{ $service->service_name }}</h6>
                    <p class="small" style="color: var(--text-muted);">{{ Str::limit($service->description, 80) }}</p>
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold gold-text">
                            @if($service->price)
                                {{ number_format($service->price, 2) }} $ / {{ $service->price_type }}
                            @else
                                السعر غير محدد
                            @endif
                        </span>
                        <span class="badge-rizk badge-rizk-gold">{{ $service->is_active ? 'نشط' : 'غير نشط' }}</span>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('service-provider.services.edit', $service->id) }}" class="btn btn-rizk-outline btn-sm w-100">تعديل</a>
                    <form action="{{ route('service-provider.services.delete', $service->id) }}" method="POST" class="mt-1">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card-rizk text-center p-5">
                <i class="fas fa-concierge-bell fa-3x gold-text mb-3"></i>
                <h5 style="color: var(--text-primary);">لا توجد خدمات</h5>
                <a href="{{ route('service-provider.services.create') }}" class="btn btn-rizk-primary">إضافة خدمة</a>
            </div>
        </div>
        @endforelse
    </div>
    {{ $services->links() }}
</div>
@endsection
