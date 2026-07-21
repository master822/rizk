@extends('layouts.app')

@section('title', 'لوحة التحكم - مقدم خدمات')

@section('content')
<div class="container py-4">
    <h4 class="section-title-rizk">لوحة التحكم - مقدم خدمات</h4>
    <p style="color: var(--text-muted);">مرحباً {{ Auth::user()->name }} 👋</p>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card-rizk text-center p-3">
                <h2 style="color: var(--primary-color);">{{ $services }}</h2>
                <p style="color: var(--text-muted);">الخدمات</p>
                <a href="{{ route('service-provider.services') }}" class="btn btn-rizk-outline btn-sm">عرض</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-rizk text-center p-3">
                <h2 style="color: var(--primary-color);">{{ $jobs }}</h2>
                <p style="color: var(--text-muted);">فرص العمل</p>
                <a href="{{ route('service-provider.jobs') }}" class="btn btn-rizk-outline btn-sm">عرض</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-rizk text-center p-3">
                <h2 style="color: var(--primary-color);">{{ $messages }}</h2>
                <p style="color: var(--text-muted);">الرسائل</p>
                <a href="{{ route('service-provider.messages') }}" class="btn btn-rizk-outline btn-sm">عرض</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-rizk text-center p-3">
                <i class="fas fa-user fa-3x gold-text mb-2"></i>
                <p style="color: var(--text-muted);">الملف الشخصي</p>
                <a href="{{ route('service-provider.profile') }}" class="btn btn-rizk-primary btn-sm">تعديل</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card-rizk p-3">
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('service-provider.services.create') }}" class="btn btn-rizk-primary">+ إضافة خدمة</a>
                    <a href="{{ route('service-provider.jobs.create') }}" class="btn btn-rizk-success">+ نشر فرصة عمل</a>
                    <a href="{{ route('service-provider.profile') }}" class="btn btn-rizk-outline">تعديل الملف الشخصي</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
