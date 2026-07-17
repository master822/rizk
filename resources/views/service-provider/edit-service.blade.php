@extends('layouts.app')

@section('title', 'تعديل خدمة')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-rizk p-4">
                <h5 style="color: var(--text-primary);">تعديل الخدمة</h5>
                <form action="{{ route('service-provider.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label style="color: var(--text-primary);">اسم الخدمة *</label>
                        <input type="text" name="service_name" class="form-control form-rizk" value="{{ $service->service_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label style="color: var(--text-primary);">الوصف</label>
                        <textarea name="description" class="form-control form-rizk" rows="4">{{ $service->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label style="color: var(--text-primary);">السعر</label>
                        <input type="number" name="price" class="form-control form-rizk" step="0.01" value="{{ $service->price }}">
                    </div>
                    <div class="mb-3">
                        <label style="color: var(--text-primary);">نوع السعر</label>
                        <select name="price_type" class="form-select form-rizk">
                            <option value="fixed" {{ $service->price_type == 'fixed' ? 'selected' : '' }}>ثابت</option>
                            <option value="hourly" {{ $service->price_type == 'hourly' ? 'selected' : '' }}>ساعة</option>
                            <option value="daily" {{ $service->price_type == 'daily' ? 'selected' : '' }}>يومي</option>
                            <option value="weekly" {{ $service->price_type == 'weekly' ? 'selected' : '' }}>أسبوعي</option>
                            <option value="monthly" {{ $service->price_type == 'monthly' ? 'selected' : '' }}>شهري</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label style="color: var(--text-primary);">المدينة</label>
                        <input type="text" name="city" class="form-control form-rizk" value="{{ $service->city }}">
                    </div>
                    <div class="mb-3">
                        <label style="color: var(--text-primary);">الصور</label>
                        <input type="file" name="images[]" class="form-control form-rizk" accept="image/*" multiple>
                    </div>
                    <button type="submit" class="btn btn-rizk-primary">تحديث الخدمة</button>
                    <a href="{{ route('service-provider.services') }}" class="btn btn-rizk-outline">إلغاء</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
