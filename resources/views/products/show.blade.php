@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container py-4">
    <div class="row g-4">
        <!-- الصور -->
        <div class="col-md-6">
            <div class="product-gallery">
                @php
                    $images = [];
                    if ($product->images) {
                        $decoded = json_decode($product->images, true);
                        if (is_array($decoded) && count($decoded) > 0) {
                            foreach ($decoded as $img) {
                                if (!empty($img)) {
                                    if (!str_starts_with($img, 'http')) {
                                        $images[] = asset('storage/' . $img);
                                    } else {
                                        $images[] = $img;
                                    }
                                }
                            }
                        }
                    }
                    
                    if (empty($images)) {
                        $images = [asset('storage/products/product_1.png')];
                    }
                    
                    $images = array_unique($images);
                    $images = array_values($images);
                @endphp
                
                <div class="main-image mb-3">
                    <img src="{{ $images[0] ?? asset('storage/products/product_1.png') }}" 
                         id="mainImage"
                         alt="{{ $product->name }}"
                         class="img-fluid rounded"
                         style="width: 100%; height: 400px; object-fit: cover; border-radius: 16px;">
                </div>
                
                @if(count($images) > 1)
                    <div class="thumbnail-gallery d-flex gap-2 flex-wrap">
                        @foreach($images as $index => $image)
                            <div class="thumbnail-item" 
                                 style="width: 80px; height: 80px; cursor: pointer; border: 2px solid {{ $index == 0 ? 'var(--primary-color)' : 'transparent' }}; border-radius: 8px; overflow: hidden; transition: all 0.3s ease;"
                                 onmouseover="this.style.borderColor='var(--primary-color)'"
                                 onmouseout="this.style.borderColor='{{ $index == 0 ? 'var(--primary-color)' : 'transparent' }}'"
                                 onclick="changeMainImage('{{ $image }}', this)">
                                <img src="{{ $image }}" 
                                     alt="{{ $product->name }} - صورة {{ $index + 1 }}"
                                     style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        
        <!-- معلومات المنتج -->
        <div class="col-md-6">
            <div class="product-info">
                <h1 class="product-title" style="color: var(--text-primary); font-weight: 800; font-size: 1.8rem;">
                    {{ $product->name }}
                </h1>
                
                <div class="product-meta mb-3">
                    <span class="badge-rizk badge-rizk-gold">
                        {{ $product->condition == 'new' ? 'جديد' : ($product->condition == 'used' ? 'مستعمل' : $product->condition) }}
                    </span>
                    <span class="text-muted mx-2">|</span>
                    <span class="text-muted">
                        <i class="fas fa-store me-1"></i>
                        {{ $product->user->store_name ?? $product->user->name ?? 'غير معروف' }}
                    </span>
                    <span class="text-muted mx-2">|</span>
                    <span class="text-muted">
                        <i class="fas fa-eye me-1"></i>
                        {{ $product->views ?? 0 }} مشاهدة
                    </span>
                    <span class="text-muted mx-2">|</span>
                    <span class="text-muted">
                        <i class="fas fa-heart me-1" style="color: #ef4444;"></i>
                        <span id="likes-count-display">{{ $product->getLikesCountAttribute() }}</span>
                    </span>
                </div>
                
                <div class="product-price mb-4">
                    <span style="font-size: 2rem; font-weight: 800; color: var(--primary-color);">
                        {{ number_format($product->price ?? 0, 2) }} TL
                    </span>
                </div>
                
                <div class="product-description mb-4">
                    <h6 style="color: var(--text-primary); font-weight: 700;">الوصف</h6>
                    <p style="color: var(--text-secondary); line-height: 1.8;">
                        {{ $product->description }}
                    </p>
                </div>
                
                <!-- عدد القطع المتاحة -->
                @if($product->quantity)
                    <div class="product-quantity mb-3">
                        <span style="color: var(--text-muted);">
                            <i class="fas fa-boxes me-1"></i>
                            القطع المتاحة: <strong style="color: var(--text-primary);">{{ $product->quantity }}</strong>
                        </span>
                    </div>
                @endif
                
                <!-- أزرار الإجراءات -->
                <div class="product-actions d-flex flex-wrap gap-2">
                    <!-- زر الإعجاب -->
                    <button class="btn btn-like {{ Auth::check() && $product->isLikedByUser(Auth::id()) ? 'liked' : '' }}" 
                            data-product-id="{{ $product->id }}"
                            onclick="toggleLike({{ $product->id }}, this)"
                            style="display: flex; align-items: center; gap: 8px; padding: 10px 20px; border-radius: 12px; border: 2px solid #e2e8f0; background: var(--bg-card); cursor: pointer; transition: all 0.3s ease;">
                        <i class="fas fa-heart" style="font-size: 1.2rem; transition: all 0.3s ease;"></i>
                        <span class="likes-count" style="font-weight: 600;">{{ $product->getLikesCountAttribute() }}</span>
                    </button>
                    
                    @auth
                        @if(Auth::id() != $product->user_id)
                            <a href="{{ route('messages.contact.form', $product->id) }}" 
                               class="btn btn-rizk-primary flex-fill">
                                <i class="fas fa-envelope me-2"></i>تواصل مع البائع
                            </a>
                        @endif
                    @endauth
                    
                    @if($canEdit)
                        <a href="{{ route('products.edit', $product->id) }}" 
                           class="btn btn-warning flex-fill">
                            <i class="fas fa-edit me-2"></i>تعديل
                        </a>
                    @endif
                </div>
                
                @if($canEdit)
                    <div class="mt-2">
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100" onclick="return confirm('هل أنت متأكد من حذف هذا المنتج؟')">
                                <i class="fas fa-trash me-2"></i>حذف المنتج
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- منتجات مشابهة -->
    @if(isset($similarProducts) && $similarProducts->count() > 0)
        <div class="mt-5">
            <h4 class="section-title-rizk">منتجات مشابهة</h4>
            <div class="row g-3">
                @foreach($similarProducts as $similar)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="{{ route('products.show', $similar->id) }}" class="text-decoration-none">
                            <div class="card-rizk hover-scale">
                                <div class="product-img-wrapper" style="height: 150px; overflow: hidden;">
                                    @php
                                        $simImage = asset('storage/products/product_1.png');
                                        if ($similar->images) {
                                            $simImages = json_decode($similar->images, true);
                                            if (is_array($simImages) && count($simImages) > 0) {
                                                $firstSim = $simImages[0];
                                                if (!str_starts_with($firstSim, 'http')) {
                                                    $simImage = asset('storage/' . $firstSim);
                                                } else {
                                                    $simImage = $firstSim;
                                                }
                                            }
                                        }
                                    @endphp
                                    <img src="{{ $simImage }}" 
                                         alt="{{ $similar->name }}"
                                         style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div class="p-3">
                                    <h6 style="color: var(--text-primary);">{{ $similar->name }}</h6>
                                    <span style="color: var(--primary-color); font-weight: 700;">
                                        {{ number_format($similar->price ?? 0, 2) }} TL
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

<script>
function changeMainImage(imageUrl, element) {
    document.getElementById('mainImage').src = imageUrl;
    document.querySelectorAll('.thumbnail-item').forEach(item => {
        item.style.borderColor = 'transparent';
    });
    element.style.borderColor = 'var(--primary-color)';
}

function toggleLike(productId, element) {
    fetch(`/products/${productId}/like`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const isLiked = data.is_liked;
            const likesCount = data.likes_count;
            
            // تحديث عدد الإعجابات في الزر
            const countSpan = element.querySelector('.likes-count');
            if (countSpan) {
                countSpan.textContent = likesCount;
            }
            
            // تحديث عدد الإعجابات في الأعلى
            const displayCount = document.getElementById('likes-count-display');
            if (displayCount) {
                displayCount.textContent = likesCount;
            }
            
            // تحديث حالة الزر
            if (isLiked) {
                element.classList.add('liked');
            } else {
                element.classList.remove('liked');
            }
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>

<style>
    .product-gallery {
        background: var(--bg-card);
        border-radius: 16px;
        padding: 20px;
        box-shadow: var(--shadow-sm);
    }
    
    .main-image {
        overflow: hidden;
        border-radius: 12px;
        background: #f1f5f9;
    }
    
    .main-image img {
        transition: transform 0.5s ease;
    }
    
    .main-image img:hover {
        transform: scale(1.02);
    }
    
    .thumbnail-item {
        transition: all 0.3s ease;
    }
    
    .thumbnail-item:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
    }
    
    .badge-rizk {
        padding: 6px 14px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.75rem;
    }
    
    .badge-rizk-gold {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: #fff;
    }
    
    .btn-like {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 12px;
        border: 2px solid #e2e8f0;
        background: var(--bg-card);
        cursor: pointer;
        transition: all 0.3s ease;
        color: #94a3b8;
    }
    
    .btn-like:hover {
        border-color: #ef4444;
        background: rgba(239, 68, 68, 0.05);
    }
    
    .btn-like.liked {
        border-color: #ef4444;
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }
    
    .btn-like.liked .fa-heart {
        animation: heartBeat 0.3s ease;
    }
    
    .btn-like .fa-heart {
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }
    
    .btn-like .likes-count {
        font-weight: 600;
    }
    
    @keyframes heartBeat {
        0% { transform: scale(1); }
        50% { transform: scale(1.3); }
        100% { transform: scale(1); }
    }
    
    @media (max-width: 768px) {
        .main-image img {
            height: 250px !important;
        }
        .thumbnail-item {
            width: 60px !important;
            height: 60px !important;
        }
    }
</style>
@endsection
