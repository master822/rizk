@extends('layouts.app')

@section('title', 'تواصل مع الناشر')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-rizk p-4">
                <h4 class="text-center mb-4" style="color: var(--text-primary);">
                    <i class="fas fa-envelope me-2"></i>تواصل مع الناشر
                </h4>
                
                <div class="job-info mb-4 p-3" style="background: var(--bg-body); border-radius: 12px;">
                    <h5 style="color: var(--text-primary);">{{ $job->title }}</h5>
                    <p style="color: var(--text-muted);">
                        <i class="fas fa-user me-1"></i>{{ $job->user->name ?? 'غير معروف' }}
                        @if($job->location)
                            <span class="mx-2">|</span>
                            <i class="fas fa-map-marker-alt me-1"></i>{{ $job->location }}
                        @endif
                    </p>
                    @if($job->salary_min)
                        <span style="color: var(--primary-color); font-weight: 700;">
                            {{ number_format($job->salary_min, 2) }} - {{ number_format($job->salary_max, 2) }} {{ $job->salary_type }}
                        </span>
                    @endif
                </div>
                
                <form action="{{ route('messages.contact.job.send', $job->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="message" class="form-label" style="color: var(--text-primary);">الرسالة</label>
                        <textarea name="message" id="message" class="form-control form-rizk" rows="5" 
                                  placeholder="اكتب رسالتك هنا..." required></textarea>
                        @error('message')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-rizk-primary">
                            <i class="fas fa-paper-plane me-2"></i>إرسال الرسالة
                        </button>
                        <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-rizk-outline">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
