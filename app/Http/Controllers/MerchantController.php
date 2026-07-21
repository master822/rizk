<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MerchantController extends Controller
{
    public function merchantsList()
    {
        $merchants = User::where('user_type', 'merchant')
                        ->where('is_active', 1)
                        ->with(['ratings', 'products'])
                        ->withCount('products')
                        ->paginate(12);
        
        return view('merchants.index', compact('merchants'));
    }

    public function show($id)
    {
        $merchant = User::where('user_type', 'merchant')
                       ->where('is_active', 1)
                       ->with(['ratings', 'products' => function($query) {
                           $query->where('status', 'active');
                       }])
                       ->findOrFail($id);
        
        return view('merchants.show', compact('merchant'));
    }

    public function byCategory($category)
    {
        $merchants = User::where('user_type', 'merchant')
                        ->where('is_active', 1)
                        ->where('store_category', $category)
                        ->with(['ratings', 'products'])
                        ->withCount('products')
                        ->paginate(12);
        
        return view('merchants.index', compact('merchants'));
    }

    public function dashboard()
    {
        $user = Auth::user();
        $products = Product::where('user_id', $user->id)->count();
        $ratings = Rating::where('merchant_id', $user->id)->avg('rating') ?? 0;
        
        return view('merchant.dashboard', compact('user', 'products', 'ratings'));
    }

    public function myProducts()
    {
        $products = Product::where('user_id', Auth::id())
                          ->orderBy('created_at', 'desc')
                          ->paginate(12);
        
        return view('merchant.products', compact('products'));
    }

    public function getCategoryName($categorySlug)
    {
        $categories = [
            'clothes' => '👗 ملابس',
            'electronics' => '📱 إلكترونيات',
            'home' => '🛋️ أدوات منزلية',
            'grocery' => '🛒 بقالة',
            'cars' => '🚗 سيارات',
            'real_estate' => '🏠 عقارات',
            'cleaning' => '🧹 ورشة تنظيف',
        ];
        
        return $categories[$categorySlug] ?? 'غير معروف';
    }
}
