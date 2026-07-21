@extends('layouts.app')

@section('title', $job->title)

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card-rizk p-4">
                <div class="d-flex justify-content-between align-items-start">
                    <h2 style="color: var(--text-primary);">{{ $job->title }}</h2>
                    <span class="badge-rizk badge-rizk-gold">{{ $job->category_name }}</span>
                </div>
                
                <div class="d-flex gap-3 mt-3">
                    <span style="color: var(--text-muted);">
                        <i class="fas fa-user me-1"></i>{{ $job->user->name ?? 'غير معروف' }}
                    </span>
                    <span style="color: var(--text-muted);">
                        <i class="fas fa-calendar me-1"></i>{{ $job->created_at->diffForHumans() }}
                    </span>
                    @if($job->location)
                        <span style="color: var(--text-muted);">
                            <i class="fas fa-map-marker-alt me-1"></i>{{ $job->location }}
                        </span>
                    @endif
                </div>

                @if($job->salary_min)
                    <div class="mt-3 p-3" style="background: var(--bg-body); border-radius: 12px;">
                        <span style="color: var(--primary-color); font-weight: 700;">
                            الراتب: {{ number_format($job->salary_min, 2) }} - {{ number_format($job->salary_max, 2) }} {{ $job->salary_type }}
                        </span>
                    </div>
                @endif

                <div class="mt-4">
                    <h6 style="color: var(--text-primary);">الوصف</h6>
                    <p style="color: var(--text-secondary); line-height: 1.8;">{{ $job->description }}</p>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <a href="{{ route('messages.contact.job', $job->id) }}" class="btn btn-rizk-primary">
                        <i class="fas fa-envelope me-2"></i>تواصل مع الناشر
                    </a>
                    <a href="{{ route('jobs.index') }}" class="btn btn-rizk-outline">
                        <i class="fas fa-arrow-right me-2"></i>عودة
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card-rizk p-4">
                <h6 style="color: var(--text-primary);">معلومات سريعة</h6>
                <hr>
                <div class="mb-2">
                    <strong style="color: var(--text-muted);">النوع:</strong>
                    <span>{{ $job->category_name }}</span>
                </div>
                @if($job->location)
                    <div class="mb-2">
                        <strong style="color: var(--text-muted);">الموقع:</strong>
                        <span>{{ $job->location }}</span>
                    </div>
                @endif
                <div class="mb-2">
                    <strong style="color: var(--text-muted);">الحالة:</strong>
                    <span class="{{ $job->is_active ? 'text-success' : 'text-danger' }}">
                        {{ $job->is_active ? 'نشطة' : 'منتهية' }}
                    </span>
                </div>
                <div class="mb-2">
                    <strong style="color: var(--text-muted);">تاريخ النشر:</strong>
                    <span>{{ $job->created_at->format('Y-m-d') }}</span>
                </div>
                @if($job->expires_at)
                    <div class="mb-2">
                        <strong style="color: var(--text-muted);">تنتهي في:</strong>
                        <span>{{ $job->expires_at->format('Y-m-d') }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
