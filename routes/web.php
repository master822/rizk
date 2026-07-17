<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\MerchantDiscountController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MerchantSubscriptionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\MerchantDashboardController;
use App\Http\Controllers\ServiceProviderDashboardController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SearchController;

// الصفحة الرئيسية
Route::get('/', [HomeController::class, 'index'])->name('home');

// المصادقة
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// الملف الشخصي (لجميع المستخدمين)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/change-password', [ProfileController::class, 'showChangePassword'])->name('change-password');
    Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('change-password.update');
});

// المنتجات (العامة)
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/new', [ProductController::class, 'newProducts'])->name('products.new');
Route::get('/products/used', [ProductController::class, 'usedProducts'])->name('products.used');
Route::get('/products/category/{categorySlug}', [ProductController::class, 'byCategory'])->name('products.byCategory');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// المنتجات المستعملة
Route::get('/used-products', [ProductController::class, 'usedProducts'])->name('used-products');

// لوحة تحكم المستخدم العادي
Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/products', [UserDashboardController::class, 'myProducts'])->name('user.products');
    Route::get('/products/create', [UserDashboardController::class, 'createProduct'])->name('user.products.create');
    Route::post('/products', [UserDashboardController::class, 'storeProduct'])->name('user.products.store');
    Route::get('/products/{id}/edit', [UserDashboardController::class, 'editProduct'])->name('user.products.edit');
    Route::put('/products/{id}', [UserDashboardController::class, 'updateProduct'])->name('user.products.update');
    Route::delete('/products/{id}', [UserDashboardController::class, 'deleteProduct'])->name('user.products.delete');
    Route::get('/messages', [UserDashboardController::class, 'messages'])->name('user.messages');
    Route::post('/messages/{id}/read', [UserDashboardController::class, 'markMessageRead'])->name('user.messages.read');
    Route::get('/profile', [UserDashboardController::class, 'profile'])->name('user.profile');
    Route::post('/profile', [UserDashboardController::class, 'updateProfile'])->name('user.profile.update');
    Route::post('/change-password', [UserDashboardController::class, 'changePassword'])->name('user.change-password');
});

// لوحة تحكم التاجر
Route::middleware(['auth'])->prefix('merchant')->group(function () {
    Route::get('/dashboard', [MerchantDashboardController::class, 'dashboard'])->name('merchant.dashboard');
    Route::get('/products', [MerchantDashboardController::class, 'myProducts'])->name('merchant.products');
    Route::get('/products/create', [MerchantDashboardController::class, 'createProduct'])->name('merchant.products.create');
    Route::post('/products', [MerchantDashboardController::class, 'storeProduct'])->name('merchant.products.store');
    Route::get('/products/{id}/edit', [MerchantDashboardController::class, 'editProduct'])->name('merchant.products.edit');
    Route::put('/products/{id}', [MerchantDashboardController::class, 'updateProduct'])->name('merchant.products.update');
    Route::delete('/products/{id}', [MerchantDashboardController::class, 'deleteProduct'])->name('merchant.products.delete');
    Route::get('/discounts', [MerchantDashboardController::class, 'discounts'])->name('merchant.discounts');
    Route::get('/discounts/create', [MerchantDashboardController::class, 'createDiscount'])->name('merchant.discounts.create');
    Route::post('/discounts', [MerchantDashboardController::class, 'storeDiscount'])->name('merchant.discounts.store');
    Route::delete('/discounts/{id}', [MerchantDashboardController::class, 'deleteDiscount'])->name('merchant.discounts.delete');
    Route::get('/messages', [MerchantDashboardController::class, 'messages'])->name('merchant.messages');
    Route::post('/messages/{id}/read', [MerchantDashboardController::class, 'markMessageRead'])->name('merchant.messages.read');
    Route::get('/jobs', [MerchantDashboardController::class, 'jobs'])->name('merchant.jobs');
    Route::get('/jobs/create', [MerchantDashboardController::class, 'createJob'])->name('merchant.jobs.create');
    Route::post('/jobs', [MerchantDashboardController::class, 'storeJob'])->name('merchant.jobs.store');
    Route::get('/jobs/{id}/edit', [MerchantDashboardController::class, 'editJob'])->name('merchant.jobs.edit');
    Route::put('/jobs/{id}', [MerchantDashboardController::class, 'updateJob'])->name('merchant.jobs.update');
    Route::delete('/jobs/{id}', [MerchantDashboardController::class, 'deleteJob'])->name('merchant.jobs.delete');
    Route::get('/profile', [MerchantDashboardController::class, 'profile'])->name('merchant.profile');
    Route::post('/profile', [MerchantDashboardController::class, 'updateProfile'])->name('merchant.profile.update');
    Route::post('/change-password', [MerchantDashboardController::class, 'changePassword'])->name('merchant.change-password');
});

// لوحة تحكم مقدم الخدمات
Route::middleware(['auth'])->prefix('service-provider')->group(function () {
    Route::get('/dashboard', [ServiceProviderDashboardController::class, 'dashboard'])->name('service-provider.dashboard');
    Route::get('/services', [ServiceProviderDashboardController::class, 'myServices'])->name('service-provider.services');
    Route::get('/services/create', [ServiceProviderDashboardController::class, 'createService'])->name('service-provider.services.create');
    Route::post('/services', [ServiceProviderDashboardController::class, 'storeService'])->name('service-provider.services.store');
    Route::get('/services/{id}/edit', [ServiceProviderDashboardController::class, 'editService'])->name('service-provider.services.edit');
    Route::put('/services/{id}', [ServiceProviderDashboardController::class, 'updateService'])->name('service-provider.services.update');
    Route::delete('/services/{id}', [ServiceProviderDashboardController::class, 'deleteService'])->name('service-provider.services.delete');
    Route::get('/jobs', [ServiceProviderDashboardController::class, 'jobs'])->name('service-provider.jobs');
    Route::get('/jobs/create', [ServiceProviderDashboardController::class, 'createJob'])->name('service-provider.jobs.create');
    Route::post('/jobs', [ServiceProviderDashboardController::class, 'storeJob'])->name('service-provider.jobs.store');
    Route::get('/jobs/{id}/edit', [ServiceProviderDashboardController::class, 'editJob'])->name('service-provider.jobs.edit');
    Route::put('/jobs/{id}', [ServiceProviderDashboardController::class, 'updateJob'])->name('service-provider.jobs.update');
    Route::delete('/jobs/{id}', [ServiceProviderDashboardController::class, 'deleteJob'])->name('service-provider.jobs.delete');
    Route::get('/messages', [ServiceProviderDashboardController::class, 'messages'])->name('service-provider.messages');
    Route::post('/messages/{id}/read', [ServiceProviderDashboardController::class, 'markMessageRead'])->name('service-provider.messages.read');
    Route::get('/profile', [ServiceProviderDashboardController::class, 'profile'])->name('service-provider.profile');
    Route::post('/profile', [ServiceProviderDashboardController::class, 'updateProfile'])->name('service-provider.profile.update');
    Route::post('/change-password', [ServiceProviderDashboardController::class, 'changePassword'])->name('service-provider.change-password');
});

// التجار (العامة)
Route::get('/merchants', [MerchantController::class, 'merchantsList'])->name('merchants.index');
Route::get('/merchants/{id}', [MerchantController::class, 'show'])->name('merchants.show');

// التخفيضات (العامة)
Route::get('/discounts', [DiscountController::class, 'discounts'])->name('discounts');

// التقييمات
Route::middleware(['auth'])->group(function () {
    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
    Route::get('/ratings/{merchantId}', [RatingController::class, 'index'])->name('ratings.index');
});

// الرسائل والمحادثات
Route::middleware(['auth'])->group(function () {
    Route::post('/messages/contact/{productId}', [MessageController::class, 'contactMerchant'])->name('messages.contact');
    Route::post('/messages/contact-seller/{productId}', [MessageController::class, 'contactProductSeller'])->name('messages.contact-seller');
    Route::get('/messages/inbox', [MessageController::class, 'inbox'])->name('messages.inbox');
    Route::get('/messages/sent', [MessageController::class, 'sent'])->name('messages.sent');
    Route::post('/messages/{id}/read', [MessageController::class, 'markAsRead'])->name('messages.markAsRead');
    Route::get('/messages/conversation/{userId}', [MessageController::class, 'showConversation'])->name('messages.conversation');
    Route::post('/messages/conversation/{userId}/send', [MessageController::class, 'sendMessageInConversation'])->name('messages.send-conversation');
    Route::post('/messages/{messageId}/reply', [MessageController::class, 'replyToMessage'])->name('messages.reply');
});

// الخدمات (العامة)
Route::view('/services/cooking', 'services.cooking')->name('services.cooking');
Route::view('/services/vegetables', 'services.vegetables')->name('services.vegetables');
Route::view('/services/transport', 'services.transport')->name('services.transport');
Route::view('/services/jobs', 'services.jobs')->name('services.jobs');
Route::view('/services/hire-worker', 'services.hire-worker')->name('services.hire-worker');
Route::view('/services/hire-technician', 'services.hire-technician')->name('services.hire-technician');
Route::view('/services/cleaning-company', 'services.cleaning-company')->name('services.cleaning-company');

// صفحات إضافية
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/terms', 'terms')->name('terms');

// صفحة الألوان (للاختبار)
Route::view('/colors-preview', 'colors-preview')->name('colors-preview');

// البحث
Route::get('/search/products', [SearchController::class, 'searchProducts'])->name('search.products');
Route::get('/search/merchants', [SearchController::class, 'searchMerchants'])->name('search.merchants');
Route::get('/search/discounts', [SearchController::class, 'searchDiscounts'])->name('search.discounts');
Route::get('/search/used-products', [SearchController::class, 'searchUsedProducts'])->name('search.used-products');
Route::get('/search/services', [SearchController::class, 'searchServices'])->name('search.services');

// اختبار الدفع
Route::get('/test-payment', function() {
    return view('test-payment');
});
