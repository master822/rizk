@extends('layouts.app')

@section('title', 'الرسائل المرسلة')

@section('content')
<div class="container py-4">
    <h4 class="section-title-rizk mb-3">الرسائل المرسلة</h4>
    
    <div class="card-rizk p-3">
        @forelse($messages as $message)
            <div class="message-item border-bottom py-3">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="d-flex gap-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($message->receiver->name ?? '') }}&size=40&background=d4af37&color=fff" 
                             class="rounded-circle" width="40" height="40">
                        <div>
                            <h6 style="color: var(--text-primary); margin: 0;">
                                إلى: {{ $message->receiver->name ?? 'غير معروف' }}
                            </h6>
                            <p style="color: var(--text-muted); font-size: 0.9rem; margin: 0;">
                                {{ Str::limit($message->message, 100) }}
                            </p>
                            @if($message->product)
                                <small style="color: var(--text-muted);">
                                    <i class="fas fa-box me-1"></i>{{ $message->product->name }}
                                </small>
                            @endif
                        </div>
                    </div>
                    <div class="text-end">
                        <small style="color: var(--text-muted);">{{ $message->created_at->diffForHumans() }}</small>
                        <div class="mt-1">
                            <a href="{{ route('messages.conversation', $message->receiver_id) }}" 
                               class="btn btn-rizk-primary btn-sm">
                                <i class="fas fa-reply me-1"></i>مراسلة
                            </a>
                            <form action="{{ route('messages.delete', $message->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <i class="fas fa-paper-plane fa-3x gold-text mb-3"></i>
                <p style="color: var(--text-muted);">لا توجد رسائل مرسلة</p>
            </div>
        @endforelse
    </div>
    
    {{ $messages->links() }}
</div>
@endsection
