<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\Discount;

class SearchController extends Controller
{
    // بحث المنتجات
    public function searchProducts(Request $request)
    {
        $query = $request->get('q');
        $category = $request->get('category');
        $minPrice = $request->get('min_price');
        $maxPrice = $request->get('max_price');
        $condition = $request->get('condition');
        $sort = $request->get('sort', 'latest');
        
        $products = Product::query()
            ->when($query, function($q) use ($query) {
                return $q->where('name', 'LIKE', "%{$query}%")
                         ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->when($category, function($q) use ($category) {
                return $q->where('category_id', $category);
            })
            ->when($minPrice, function($q) use ($minPrice) {
                return $q->where('price', '>=', $minPrice);
            })
            ->when($maxPrice, function($q) use ($maxPrice) {
                return $q->where('price', '<=', $maxPrice);
            })
            ->when($condition, function($q) use ($condition) {
                return $q->where('condition', $condition);
            })
            ->when($sort == 'latest', function($q) {
                return $q->orderBy('created_at', 'desc');
            })
            ->when($sort == 'price_low', function($q) {
                return $q->orderBy('price', 'asc');
            })
            ->when($sort == 'price_high', function($q) {
                return $q->orderBy('price', 'desc');
            })
            ->with(['user', 'category'])
            ->paginate(12);
        
        $categories = Category::where('is_active', 1)->get();
        
        return view('search.products', compact('products', 'categories', 'query', 'category', 'minPrice', 'maxPrice', 'condition', 'sort'));
    }
    
    // بحث التجار
    public function searchMerchants(Request $request)
    {
        $query = $request->get('q');
        $category = $request->get('category');
        $sort = $request->get('sort', 'latest');
        
        $merchants = User::where('user_type', 'merchant')
            ->where('is_active', 1)
            ->when($query, function($q) use ($query) {
                return $q->where('name', 'LIKE', "%{$query}%")
                         ->orWhere('store_name', 'LIKE', "%{$query}%")
                         ->orWhere('city', 'LIKE', "%{$query}%");
            })
            ->when($category, function($q) use ($category) {
                return $q->whereHas('products', function($query) use ($category) {
                    $query->where('category_id', $category);
                });
            })
            ->when($sort == 'latest', function($q) {
                return $q->orderBy('created_at', 'desc');
            })
            ->when($sort == 'name', function($q) {
                return $q->orderBy('name', 'asc');
            })
            ->with(['products' => function($q) {
                $q->with('category')->limit(5);
            }])
            ->paginate(12);
        
        $categories = Category::where('is_active', 1)->get();
        
        return view('search.merchants', compact('merchants', 'categories', 'query', 'category', 'sort'));
    }
    
    // بحث التخفيضات
    public function searchDiscounts(Request $request)
    {
        $query = $request->get('q');
        $category = $request->get('category');
        $minDiscount = $request->get('min_discount');
        $maxDiscount = $request->get('max_discount');
        $sort = $request->get('sort', 'latest');
        
        $discounts = Discount::query()
            ->where('is_active', 1)
            ->when($query, function($q) use ($query) {
                return $q->where('title', 'LIKE', "%{$query}%")
                         ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->when($category, function($q) use ($category) {
                return $q->whereHas('product', function($query) use ($category) {
                    $query->where('category_id', $category);
                });
            })
            ->when($minDiscount, function($q) use ($minDiscount) {
                return $q->where('percentage', '>=', $minDiscount);
            })
            ->when($maxDiscount, function($q) use ($maxDiscount) {
                return $q->where('percentage', '<=', $maxDiscount);
            })
            ->when($sort == 'latest', function($q) {
                return $q->orderBy('created_at', 'desc');
            })
            ->when($sort == 'discount_high', function($q) {
                return $q->orderBy('percentage', 'desc');
            })
            ->with(['product', 'merchant'])
            ->paginate(12);
        
        $categories = Category::where('is_active', 1)->get();
        
        return view('search.discounts', compact('discounts', 'categories', 'query', 'category', 'minDiscount', 'maxDiscount', 'sort'));
    }
    
    // بحث المنتجات المستعملة
    public function searchUsedProducts(Request $request)
    {
        $query = $request->get('q');
        $category = $request->get('category');
        $minPrice = $request->get('min_price');
        $maxPrice = $request->get('max_price');
        $sort = $request->get('sort', 'latest');
        
        $products = Product::query()
            ->where('condition', 'used')
            ->when($query, function($q) use ($query) {
                return $q->where('name', 'LIKE', "%{$query}%")
                         ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->when($category, function($q) use ($category) {
                return $q->where('category_id', $category);
            })
            ->when($minPrice, function($q) use ($minPrice) {
                return $q->where('price', '>=', $minPrice);
            })
            ->when($maxPrice, function($q) use ($maxPrice) {
                return $q->where('price', '<=', $maxPrice);
            })
            ->when($sort == 'latest', function($q) {
                return $q->orderBy('created_at', 'desc');
            })
            ->when($sort == 'price_low', function($q) {
                return $q->orderBy('price', 'asc');
            })
            ->when($sort == 'price_high', function($q) {
                return $q->orderBy('price', 'desc');
            })
            ->with(['user', 'category'])
            ->paginate(12);
        
        $categories = Category::where('is_active', 1)->get();
        
        return view('search.used-products', compact('products', 'categories', 'query', 'category', 'minPrice', 'maxPrice', 'sort'));
    }
    
    // بحث الخدمات
    public function searchServices(Request $request)
    {
        $query = $request->get('q');
        $serviceType = $request->get('service_type');
        $city = $request->get('city');
        $sort = $request->get('sort', 'latest');
        
        // هذه محاكاة للخدمات - يمكنك ربطها بقاعدة بيانات الخدمات
        $services = collect([
            (object) [
                'id' => 1,
                'name' => 'طبخ منزل',
                'type' => 'cooking',
                'description' => 'خدمة طبخ منزلية بجودة عالية',
                'price' => 50,
                'city' => 'دمشق',
                'user' => (object) ['name' => 'أحمد', 'avatar' => 'https://ui-avatars.com/api/?name=أحمد'],
                'created_at' => now()->subDays(2),
                'rating' => 4.5,
                'image' => 'https://via.placeholder.com/300x200/6366f1/ffffff?text=طبخ+منزل'
            ],
            (object) [
                'id' => 2,
                'name' => 'خضار مقطعة',
                'type' => 'vegetables',
                'description' => 'خضار طازجة مقطعة وجاهزة للطبخ',
                'price' => 25,
                'city' => 'دمشق',
                'user' => (object) ['name' => 'محمد', 'avatar' => 'https://ui-avatars.com/api/?name=محمد'],
                'created_at' => now()->subDays(1),
                'rating' => 4.8,
                'image' => 'https://via.placeholder.com/300x200/22c55e/ffffff?text=خضار+مقطعة'
            ],
            (object) [
                'id' => 3,
                'name' => 'سيارة نقل',
                'type' => 'transport',
                'description' => 'سيارة نقل للبضائع والأثاث',
                'price' => 100,
                'city' => 'حلب',
                'user' => (object) ['name' => 'علي', 'avatar' => 'https://ui-avatars.com/api/?name=علي'],
                'created_at' => now()->subHours(5),
                'rating' => 4.2,
                'image' => 'https://via.placeholder.com/300x200/f59e0b/ffffff?text=سيارة+نقل'
            ],
            (object) [
                'id' => 4,
                'name' => 'فرص عمل - مطور ويب',
                'type' => 'jobs',
                'description' => 'مطلوب مطور ويب للعمل عن بعد',
                'price' => 0,
                'city' => 'دمشق',
                'user' => (object) ['name' => 'شركة تقنية', 'avatar' => 'https://ui-avatars.com/api/?name=شركة'],
                'created_at' => now()->subDays(3),
                'rating' => 0,
                'image' => 'https://via.placeholder.com/300x200/06b6d4/ffffff?text=فرص+عمل'
            ],
            (object) [
                'id' => 5,
                'name' => 'استأجر عامل بناء',
                'type' => 'hire-worker',
                'description' => 'عامل بناء ماهر للعمل في مشاريع البناء',
                'price' => 40,
                'city' => 'حماة',
                'user' => (object) ['name' => 'خالد', 'avatar' => 'https://ui-avatars.com/api/?name=خالد'],
                'created_at' => now()->subDays(4),
                'rating' => 4.0,
                'image' => 'https://via.placeholder.com/300x200/64748b/ffffff?text=استأجر+عامل'
            ],
            (object) [
                'id' => 6,
                'name' => 'استأجر فني تكييف',
                'type' => 'hire-technician',
                'description' => 'فني تكييف وتبريد معتمد',
                'price' => 60,
                'city' => 'اللاذقية',
                'user' => (object) ['name' => 'سامر', 'avatar' => 'https://ui-avatars.com/api/?name=سامر'],
                'created_at' => now()->subHours(2),
                'rating' => 4.9,
                'image' => 'https://via.placeholder.com/300x200/ef4444/ffffff?text=استأجر+فني'
            ]
        ]);
        
        $services = $services->when($query, function($collection) use ($query) {
            return $collection->filter(function($item) use ($query) {
                return stripos($item->name, $query) !== false || 
                       stripos($item->description, $query) !== false ||
                       stripos($item->city, $query) !== false;
            });
        })
        ->when($serviceType, function($collection) use ($serviceType) {
            return $collection->where('type', $serviceType);
        })
        ->when($city, function($collection) use ($city) {
            return $collection->where('city', $city);
        })
        ->when($sort == 'latest', function($collection) {
            return $collection->sortByDesc('created_at');
        })
        ->when($sort == 'price_low', function($collection) {
            return $collection->sortBy('price');
        })
        ->when($sort == 'price_high', function($collection) {
            return $collection->sortByDesc('price');
        });
        
        $cities = ['دمشق', 'حلب', 'حمص', 'حماة', 'اللاذقية', 'طرطوس', 'دير الزور', 'الحسكة', 'الرقة'];
        
        return view('search.services', compact('services', 'query', 'serviceType', 'city', 'sort', 'cities'));
    }
}