@extends('layouts.app')

@section('title', 'إضافة تخفيض')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-rizk p-4">
                <h5 style="color: var(--text-primary);">إضافة تخفيض جديد</h5>
                <form action="{{ route('merchant.discounts.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label style="color: var(--text-primary);">اسم التخفيض *</label>
                        <input type="text" name="name" class="form-control form-rizk" required>
                    </div>
                    <div class="mb-3">
                        <label style="color: var(--text-primary);">الوصف</label>
                        <textarea name="description" class="form-control form-rizk" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label style="color: var(--text-primary);">نسبة التخفيض *</label>
                        <input type="number" name="percentage" class="form-control form-rizk" min="1" max="100" required>
                    </div>
                    <div class="mb-3">
                        <label style="color: var(--text-primary);">المنتج *</label>
                        <select name="product_id" class="form-select form-rizk" required>
                            <option value="">اختر المنتج</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }} - {{ number_format($product->price, 2) }} $</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-rizk-primary">إضافة التخفيض</button>
                    <a href="{{ route('merchant.discounts') }}" class="btn btn-rizk-outline">إلغاء</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
