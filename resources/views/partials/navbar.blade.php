<nav class="navbar navbar-expand-lg navbar-modern fixed-top">
    <div class="container">
        <div class="logo-container">
            <div class="logo-icon">
                <i class="fas fa-bolt"></i>
            </div>
            <a class="navbar-brand fw-bold gradient-text fs-3" href="{{ url('/') }}">
                عروض اليوم
            </a>
        </div>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="{{ url('/') }}">
                        <i class="fas fa-home me-1"></i>الرئيسية
                    </a>
                </li>
                
                <!-- المنتجات -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-box me-1"></i>المنتجات
                    </a>
                    <ul class="dropdown-menu animated-card">
                        <li><a class="dropdown-item" href="{{ url('/products') }}"><i class="fas fa-th me-2"></i>جميع المنتجات</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ url('/products/category/clothes') }}"><i class="fas fa-tshirt me-2"></i>ملابس</a></li>
                        <li><a class="dropdown-item" href="{{ url('/products/category/electronics') }}"><i class="fas fa-mobile-alt me-2"></i>إلكترونيات</a></li>
                        <li><a class="dropdown-item" href="{{ url('/products/category/home') }}"><i class="fas fa-home me-2"></i>أدوات منزلية</a></li>
                        <li><a class="dropdown-item" href="{{ url('/products/category/food') }}"><i class="fas fa-apple-alt me-2"></i>بقالة</a></li>
                    </ul>
                </li>

                <!-- التخفيضات -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-tag me-1"></i>التخفيضات
                    </a>
                    <ul class="dropdown-menu animated-card">
                        <li><a class="dropdown-item" href="{{ url('/discounts') }}"><i class="fas fa-th me-2"></i>جميع التخفيضات</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ url('/discounts/category/clothes') }}"><i class="fas fa-tshirt me-2"></i>تخفيضات الملابس</a></li>
                        <li><a class="dropdown-item" href="{{ url('/discounts/category/electronics') }}"><i class="fas fa-mobile-alt me-2"></i>تخفيضات الإلكترونيات</a></li>
                        <li><a class="dropdown-item" href="{{ url('/discounts/category/home') }}"><i class="fas fa-home me-2"></i>تخفيضات الأدوات المنزلية</a></li>
                        <li><a class="dropdown-item" href="{{ url('/discounts/category/food') }}"><i class="fas fa-apple-alt me-2"></i>تخفيضات البقالة</a></li>
                    </ul>
                </li>

                <!-- التجار -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-store me-1"></i>التجار
                    </a>
                    <ul class="dropdown-menu animated-card">
                        <li><a class="dropdown-item" href="{{ url('/merchants') }}"><i class="fas fa-th me-2"></i>جميع التجار</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ url('/merchants/category/clothes') }}"><i class="fas fa-tshirt me-2"></i>تجار الملابس</a></li>
                        <li><a class="dropdown-item" href="{{ url('/merchants/category/electronics') }}"><i class="fas fa-mobile-alt me-2"></i>تجار الإلكترونيات</a></li>
                        <li><a class="dropdown-item" href="{{ url('/merchants/category/home') }}"><i class="fas fa-home me-2"></i>تجار الأدوات المنزلية</a></li>
                        <li><a class="dropdown-item" href="{{ url('/merchants/category/food') }}"><i class="fas fa-apple-alt me-2"></i>تجار البقالة</a></li>
                    </ul>
                </li>

                <!-- المنتجات المستعملة -->
                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="{{ url('/used-products') }}">
                        <i class="fas fa-recycle me-1"></i>المنتجات المستعملة
                    </a>
                </li>

                <!-- خدمات -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-concierge-bell me-1"></i>خدمات
                    </a>
                    <ul class="dropdown-menu animated-card">
                        <li><a class="dropdown-item" href="{{ url('/services/cooking') }}"><i class="fas fa-utensils me-2"></i>طبخ منزل</a></li>
                        <li><a class="dropdown-item" href="{{ url('/services/vegetables') }}"><i class="fas fa-leaf me-2"></i>تجهيز خضار</a></li>
                        <li><a class="dropdown-item" href="{{ url('/services/transport') }}"><i class="fas fa-truck me-2"></i>سيارة نقل</a></li>
                        <li><a class="dropdown-item" href="{{ url('/services/jobs') }}"><i class="fas fa-briefcase me-2"></i>فرص عمل</a></li>
                        <li><a class="dropdown-item" href="{{ url('/services/hire-worker') }}"><i class="fas fa-user-tie me-2"></i>استأجر عامل</a></li>
                        <li><a class="dropdown-item" href="{{ url('/services/hire-technician') }}"><i class="fas fa-tools me-2"></i>استأجر فني</a></li>
                        <li><a class="dropdown-item" href="{{ url('/services/cleaning-company') }}"><i class="fas fa-broom me-2"></i>ورشة تنظيف</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto align-items-center">
                <!-- Theme Toggle -->
                <li class="nav-item me-3">
                    <div class="theme-toggle" id="themeToggle">
                        <i class="fas fa-moon" id="themeIcon"></i>
                    </div>
                </li>

                @auth
                    <!-- لوحة تحكم التاجر -->
                    @if(auth()->user()->user_type === 'merchant')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-crown me-1"></i>لوحة التاجر
                            </a>
                            <ul class="dropdown-menu animated-card">
                                <li><a class="dropdown-item" href="{{ url('/merchant/dashboard') }}"><i class="fas fa-chart-line me-2"></i>لوحة التحكم</a></li>
                                <li><a class="dropdown-item" href="{{ url('/merchant/products') }}"><i class="fas fa-box me-2"></i>منتجاتي</a></li>
                                <li><a class="dropdown-item" href="{{ url('/merchant/discounts') }}"><i class="fas fa-tag me-2"></i>تخفيضاتي</a></li>
                                <li><a class="dropdown-item" href="{{ url('/merchant/discounts/create') }}"><i class="fas fa-plus me-2"></i>إنشاء تخفيض</a></li>
                            </ul>
                        </li>
                    @endif

                    <!-- لوحة تحكم مقدم الخدمات -->
                    @if(auth()->user()->isServiceProvider())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-concierge-bell me-1"></i>لوحة الخدمات
                            </a>
                            <ul class="dropdown-menu animated-card">
                                <li><a class="dropdown-item" href="{{ url('/service-provider/dashboard') }}"><i class="fas fa-chart-line me-2"></i>لوحة التحكم</a></li>
                                <li><a class="dropdown-item" href="{{ url('/service-provider/services') }}"><i class="fas fa-list me-2"></i>خدماتي</a></li>
                                <li><a class="dropdown-item" href="{{ url('/service-provider/jobs/create') }}"><i class="fas fa-plus me-2"></i>نشر فرصة عمل</a></li>
                                <li><a class="dropdown-item" href="{{ url('/service-provider/jobs') }}"><i class="fas fa-briefcase me-2"></i>فرص العمل</a></li>
                            </ul>
                        </li>
                    @endif

                    <!-- لوحة تحكم المستخدم العادي -->
                    @if(auth()->user()->user_type === 'user')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-1"></i>حسابي
                            </a>
                            <ul class="dropdown-menu animated-card">
                                <li><a class="dropdown-item" href="{{ url('/user/dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>لوحتي</a></li>
                                <li><a class="dropdown-item" href="{{ url('/user/my-products') }}"><i class="fas fa-shopping-bag me-2"></i>منتجاتي المستعملة</a></li>
                                <li><a class="dropdown-item" href="{{ url('/user/messages') }}"><i class="fas fa-comments me-2"></i>الرسائل</a></li>
                            </ul>
                        </li>
                    @endif

                    <!-- لوحة المسؤول -->
                    @if(auth()->user()->user_type === 'admin')
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="{{ url('/admin/dashboard') }}"><i class="fas fa-shield-alt me-1"></i>لوحة المسؤول</a>
                        </li>
                    @endif
                    
                    <!-- زر تسجيل الخروج -->
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link fw-semibold">
                                <i class="fas fa-sign-out-alt me-1"></i>تسجيل خروج
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i>حساب
                        </a>
                        <ul class="dropdown-menu animated-card">
                            <li><a class="dropdown-item" href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-2"></i>تسجيل دخول</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('register') }}"><i class="fas fa-user-plus me-2"></i>حساب مستخدم</a></li>
                            <li><a class="dropdown-item" href="{{ route('register') }}?type=merchant"><i class="fas fa-store me-2"></i>حساب تاجر</a></li>
                            <li><a class="dropdown-item" href="{{ route('register') }}?type=service"><i class="fas fa-concierge-bell me-2"></i>حساب مقدم خدمات</a></li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
