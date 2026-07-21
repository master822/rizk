@extends('layouts.app')

@section('title', 'الرسائل الواردة')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="section-title-rizk">الرسائل الواردة</h4>
        <span class="badge-rizk badge-rizk-gold">{{ $unreadCount ?? 0 }} غير مقروءة</span>
    </div>
    
    <div class="card-rizk p-3">
        @forelse($messages as $message)
            <div class="message-item border-bottom py-3 {{ !$message->is_read ? 'bg-gold-gradient bg-opacity-10' : '' }}">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="d-flex gap-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($message->sender->name ?? '') }}&size=40&background=d4af37&color=fff" 
                             class="rounded-circle" width="40" height="40">
                        <div>
                            <h6 style="color: var(--text-primary); margin: 0;">
                                {{ $message->sender->name ?? 'غير معروف' }}
                                @if(!$message->is_read)
                                    <span class="badge bg-danger ms-2" style="font-size: 0.6rem;">جديد</span>
                                @endif
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
                            <a href="{{ route('messages.conversation', $message->sender_id) }}" 
                               class="btn btn-rizk-primary btn-sm">
                                <i class="fas fa-reply me-1"></i>رد
                            </a>
                            @if(!$message->is_read)
                                <form action="{{ route('messages.markAsRead', $message->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-rizk-outline btn-sm">تحديد كمقروء</button>
                                </form>
                            @endif
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
                <i class="fas fa-inbox fa-3x gold-text mb-3"></i>
                <p style="color: var(--text-muted);">لا توجد رسائل واردة</p>
            </div>
        @endforelse
    </div>
    
    {{ $messages->links() }}
</div>
@endsection
