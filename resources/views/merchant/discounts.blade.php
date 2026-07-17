@extends('layouts.app')

@section('title', 'التخفيضات')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="section-title-rizk">تخفيضاتي</h4>
        <a href="{{ route('merchant.discounts.create') }}" class="btn btn-rizk-primary">+ إضافة تخفيض</a>
    </div>

    <div class="row g-3">
        @forelse($discounts as $discount)
        <div class="col-md-4">
            <div class="card-rizk p-3">
                <div class="d-flex justify-content-between">
                    <h6 style="color: var(--text-primary);">{{ $discount->name }}</h6>
                    <span class="badge-rizk badge-rizk-gold">{{ $discount->percentage }}%</span>
                </div>
                <p class="small" style="color: var(--text-muted);">{{ Str::limit($discount->description, 80) }}</p>
                <div class="d-flex justify-content-between">
                    <span style="color: var(--text-muted);">{{ $discount->is_active ? 'نشط' : 'غير نشط' }}</span>
                    <form action="{{ route('merchant.discounts.delete', $discount->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card-rizk text-center p-5">
                <i class="fas fa-tag fa-3x gold-text mb-3"></i>
                <h5 style="color: var(--text-primary);">لا توجد تخفيضات</h5>
                <a href="{{ route('merchant.discounts.create') }}" class="btn btn-rizk-primary">إضافة تخفيض</a>
            </div>
        </div>
        @endforelse
    </div>
    {{ $discounts->links() }}
</div>
@endsection
