<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\MerchantDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\ServiceProviderDashboardController;

// الصفحة الرئيسية
Route::get('/', [HomeController::class, 'index'])->name('home');

// المصادقة
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// الملف الشخصي
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/change-password', [ProfileController::class, 'showChangePassword'])->name('change-password');
    Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('change-password.update');
});

// المنتجات
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/category/{categorySlug}', [ProductController::class, 'byCategory'])->name('products.byCategory');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// المنتجات المستعملة
Route::get('/used-products', [ProductController::class, 'usedProducts'])->name('used-products');

// التجار
Route::get('/merchants', [MerchantController::class, 'merchantsList'])->name('merchants.index');
Route::get('/merchants/{id}', [MerchantController::class, 'show'])->name('merchants.show');
Route::get('/merchants/category/{category}', [MerchantController::class, 'byCategory'])->name('merchants.byCategory');

// التخفيضات
Route::get('/discounts', [DiscountController::class, 'discounts'])->name('discounts');
Route::get('/discounts/{id}', [DiscountController::class, 'show'])->name('discounts.show');

// الرسائل
Route::middleware(['auth'])->group(function () {
    Route::get('/messages/contact/{productId}', [MessageController::class, 'contactMerchantForm'])->name('messages.contact.form');
    Route::post('/messages/contact/{productId}', [MessageController::class, 'contactMerchant'])->name('messages.contact');
    Route::get('/messages/inbox', [MessageController::class, 'inbox'])->name('messages.inbox');
    Route::get('/messages/sent', [MessageController::class, 'sent'])->name('messages.sent');
    Route::get('/messages/conversation/{userId}', [MessageController::class, 'showConversation'])->name('messages.conversation');
    Route::post('/messages/conversation/{userId}/send', [MessageController::class, 'sendMessageInConversation'])->name('messages.send-conversation');
    Route::delete('/messages/{id}', [MessageController::class, 'deleteMessage'])->name('messages.delete');
    Route::delete('/messages/conversation/{userId}/clear', [MessageController::class, 'clearConversation'])->name('messages.clear-conversation');
});

// فرص العمل
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/messages/contact-job/{jobId}', [MessageController::class, 'contactJobForm'])->name('messages.contact.job');
Route::post('/messages/contact-job/{jobId}', [MessageController::class, 'contactJob'])->name('messages.contact.job.send');

// الإشعارات
Route::middleware(['auth'])->prefix('notifications')->group(function () {
    Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/{id}/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::delete('/{id}', [NotificationController::class, 'delete'])->name('notifications.delete');
    Route::delete('/delete-all', [NotificationController::class, 'deleteAll'])->name('notifications.delete-all');
});

// لوحة تحكم المستخدم
Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/products', [UserDashboardController::class, 'myProducts'])->name('user.products');
    Route::get('/products/create', [UserDashboardController::class, 'createProduct'])->name('user.products.create');
    Route::post('/products', [UserDashboardController::class, 'storeProduct'])->name('user.products.store');
    Route::get('/products/{id}/edit', [UserDashboardController::class, 'editProduct'])->name('user.products.edit');
    Route::put('/products/{id}', [UserDashboardController::class, 'updateProduct'])->name('user.products.update');
    Route::delete('/products/{id}', [UserDashboardController::class, 'deleteProduct'])->name('user.products.delete');
    Route::get('/messages', [UserDashboardController::class, 'messages'])->name('user.messages');
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
    Route::get('/discounts/{id}/edit', [MerchantDashboardController::class, 'editDiscount'])->name('merchant.discounts.edit');
    Route::put('/discounts/{id}', [MerchantDashboardController::class, 'updateDiscount'])->name('merchant.discounts.update');
    Route::delete('/discounts/{id}', [MerchantDashboardController::class, 'deleteDiscount'])->name('merchant.discounts.delete');
    Route::get('/jobs', [MerchantDashboardController::class, 'jobs'])->name('merchant.jobs');
    Route::get('/jobs/create', [MerchantDashboardController::class, 'createJob'])->name('merchant.jobs.create');
    Route::post('/jobs', [MerchantDashboardController::class, 'storeJob'])->name('merchant.jobs.store');
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
    Route::get('/profile', [ServiceProviderDashboardController::class, 'profile'])->name('service-provider.profile');
    Route::post('/profile', [ServiceProviderDashboardController::class, 'updateProfile'])->name('service-provider.profile.update');
    Route::post('/change-password', [ServiceProviderDashboardController::class, 'changePassword'])->name('service-provider.change-password');
});

// الخدمات
Route::view('/services', 'services.index')->name('services.index');
Route::view('/services/cooking', 'services.cooking')->name('services.cooking');
Route::view('/services/vegetables', 'services.vegetables')->name('services.vegetables');
Route::view('/services/transport', 'services.transport')->name('services.transport');
Route::view('/services/jobs', 'services.jobs')->name('services.jobs');
Route::view('/services/hire-worker', 'services.hire-worker')->name('services.hire-worker');
Route::view('/services/hire-technician', 'services.hire-technician')->name('services.hire-technician');
Route::view('/services/cleaning-company', 'services.cleaning-company')->name('services.cleaning-company');

// البحث
Route::get('/search/products', [SearchController::class, 'searchProducts'])->name('search.products');
Route::get('/search/merchants', [SearchController::class, 'searchMerchants'])->name('search.merchants');
Route::get('/search/discounts', [SearchController::class, 'searchDiscounts'])->name('search.discounts');
Route::get('/search/used-products', [SearchController::class, 'searchUsedProducts'])->name('search.used-products');
Route::get('/search/services', [SearchController::class, 'searchServices'])->name('search.services');

// صفحات إضافية
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/terms', 'terms')->name('terms');
Route::post('/products/{id}/like', [App\Http\Controllers\ProductController::class, 'toggleLike'])->name('products.like');
Route::post('/products/{id}/like', [App\Http\Controllers\ProductController::class, 'toggleLike'])->name('products.like');
Route::post('/products/{id}/like', [App\Http\Controllers\ProductController::class, 'toggleLike'])->name('products.like');
