@extends('layouts.app')

@section('title', 'الملف الشخصي - تاجر')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card-rizk text-center p-4">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" class="rounded-circle mb-3" width="150" height="150" style="object-fit: cover;">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=150&background=d4af37&color=fff" class="rounded-circle mb-3" width="150" height="150">
                @endif
                <h5 style="color: var(--text-primary);">{{ $user->name }}</h5>
                <p style="color: var(--text-muted);">{{ $user->email }}</p>
                <p style="color: var(--text-muted);"><i class="fas fa-store me-2"></i>{{ $user->store_name ?? 'لا يوجد متجر' }}</p>
                <a href="{{ route('merchant.change-password') }}" class="btn btn-rizk-outline w-100 mt-2">تغيير كلمة المرور</a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card-rizk p-4">
                <h5 style="color: var(--text-primary);">تعديل الملف الشخصي</h5>
                <form action="{{ route('merchant.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label style="color: var(--text-primary);">الاسم</label>
                        <input type="text" name="name" class="form-control form-rizk" value="{{ $user->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label style="color: var(--text-primary);">رقم الهاتف</label>
                        <input type="text" name="phone" class="form-control form-rizk" value="{{ $user->phone }}">
                    </div>
                    <div class="mb-3">
                        <label style="color: var(--text-primary);">المدينة</label>
                        <input type="text" name="city" class="form-control form-rizk" value="{{ $user->city }}">
                    </div>
                    <div class="mb-3">
                        <label style="color: var(--text-primary);">اسم المتجر</label>
                        <input type="text" name="store_name" class="form-control form-rizk" value="{{ $user->store_name }}">
                    </div>
                    <div class="mb-3">
                        <label style="color: var(--text-primary);">وصف المتجر</label>
                        <textarea name="store_description" class="form-control form-rizk" rows="3">{{ $user->store_description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label style="color: var(--text-primary);">الصورة الشخصية</label>
                        <input type="file" name="avatar" class="form-control form-rizk" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label style="color: var(--text-primary);">شعار المتجر</label>
                        <input type="file" name="store_logo" class="form-control form-rizk" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-rizk-primary">حفظ التغييرات</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
