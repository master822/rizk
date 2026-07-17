@extends('layouts.app')

@section('title', 'الملف الشخصي')

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
                <a href="{{ route('user.change-password') }}" class="btn btn-rizk-outline w-100 mt-2">تغيير كلمة المرور</a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card-rizk p-4">
                <h5 style="color: var(--text-primary);">تعديل الملف الشخصي</h5>
                <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
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
                        <label style="color: var(--text-primary);">الصورة الشخصية</label>
                        <input type="file" name="avatar" class="form-control form-rizk" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-rizk-primary">حفظ التغييرات</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
