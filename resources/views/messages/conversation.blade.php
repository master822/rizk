@extends('layouts.app')

@section('title', 'المحادثة مع ' . $otherUser->name)

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-rizk">
                <div class="card-header bg-transparent p-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($otherUser->name) }}&size=40&background=d4af37&color=fff" 
                                 class="rounded-circle" width="40" height="40">
                            <div>
                                <h6 style="color: var(--text-primary); margin: 0;">{{ $otherUser->name }}</h6>
                                <small style="color: var(--text-muted);">{{ $otherUser->store_name ?? 'مستخدم' }}</small>
                            </div>
                        </div>
                        <div>
                            <form action="{{ route('messages.clear-conversation', $otherUser->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من مسح المحادثة؟')">
                                    <i class="fas fa-trash me-1"></i>مسح المحادثة
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-3" style="max-height: 500px; overflow-y: auto; background: var(--bg-body);">
                    @foreach($messages as $message)
                        <div class="message-item mb-3 {{ $message->sender_id == Auth::id() ? 'text-end' : '' }}">
                            <div class="d-inline-block p-3 rounded" 
                                 style="max-width: 80%; background: {{ $message->sender_id == Auth::id() ? 'var(--primary-color)' : 'var(--bg-card)' }}; 
                                        color: {{ $message->sender_id == Auth::id() ? '#fff' : 'var(--text-primary)' }};
                                        border-radius: 16px;
                                        box-shadow: var(--shadow-sm);">
                                <p style="margin: 0; word-wrap: break-word;">{{ $message->message }}</p>
                                <small style="font-size: 0.7rem; opacity: 0.7;">
                                    {{ $message->created_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                    @endforeach
                    
                    @if($messages->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-comments fa-3x gold-text mb-3"></i>
                            <p style="color: var(--text-muted);">لا توجد رسائل بعد</p>
                        </div>
                    @endif
                </div>
                
                <div class="card-footer bg-transparent p-3 border-top">
                    <form action="{{ route('messages.send-conversation', $otherUser->id) }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="message" class="form-control form-rizk" placeholder="اكتب رسالتك..." required>
                            <button type="submit" class="btn btn-rizk-primary">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
