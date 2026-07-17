<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ],
            'user_type' => 'required|in:user,merchant,service_provider',
            'phone' => [
                'required',
                'string',
                'max:20',
                'regex:/^(09|\\+9639)[0-9]{8}$/',
            ],
            'city' => 'required|string|max:255',
        ], [
            'password.regex' => 'يجب أن تحتوي كلمة المرور على حرف كبير وحرف صغير ورقم على الأقل.',
            'password.min' => 'يجب أن تكون كلمة المرور 8 أحرف على الأقل.',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق.',
            'phone.regex' => 'رقم الهاتف يجب أن يكون بصيغة سورية: 09xxxxxxxx أو +9639xxxxxxxx',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password', 'password_confirmation'));
        }

        // تنظيف رقم الهاتف
        $phone = $request->phone;
        // إذا كان الرقم يبدأ بـ 09، أضف +963
        if (str_starts_with($phone, '09')) {
            $phone = '+963' . substr($phone, 1);
        }

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $phone,
            'city' => $request->city,
            'is_active' => true,
            'product_limit' => 5,
        ];

        if ($request->user_type === 'merchant') {
            $merchantValidator = Validator::make($request->all(), [
                'store_name' => 'required|string|max:255',
                'store_category' => 'required|in:electronics,clothes,home,grocery,cars,real_estate,cleaning',
                'store_description' => 'required|string|max:500',
            ]);

            if ($merchantValidator->fails()) {
                return redirect()->back()
                    ->withErrors($merchantValidator)
                    ->withInput($request->except('password', 'password_confirmation'));
            }

            $userData = array_merge($userData, [
                'user_type' => 'merchant',
                'store_name' => $request->store_name,
                'store_category' => $request->store_category,
                'store_description' => $request->store_description,
                'product_limit' => 20,
            ]);
            
            $user = User::create($userData);
            Auth::login($user);
            return redirect()->route('merchant.dashboard')->with('success', 'تم إنشاء حساب التاجر بنجاح!');
            
        } elseif ($request->user_type === 'service_provider') {
            $serviceValidator = Validator::make($request->all(), [
                'service_type' => 'required|string',
                'service_description' => 'nullable|string|max:500',
            ]);

            if ($serviceValidator->fails()) {
                return redirect()->back()
                    ->withErrors($serviceValidator)
                    ->withInput($request->except('password', 'password_confirmation'));
            }

            $userData = array_merge($userData, [
                'user_type' => $request->service_type,
                'store_name' => $request->name . ' - خدمات',
                'store_description' => $request->service_description ?? 'مقدم خدمات',
                'product_limit' => 20,
            ]);
            
            $user = User::create($userData);
            
            Service::create([
                'user_id' => $user->id,
                'service_type' => $request->service_type,
                'service_name' => $request->name . ' - ' . $this->getServiceTypeName($request->service_type),
                'description' => $request->service_description,
                'city' => $request->city,
                'phone' => $phone,
                'is_active' => true,
            ]);
            
            Auth::login($user);
            return redirect()->route('home')->with('success', 'تم إنشاء حساب مقدم الخدمات بنجاح!');
            
        } else {
            $userData['user_type'] = 'user';
            $user = User::create($userData);
            Auth::login($user);
            return redirect()->route('home')->with('success', 'تم إنشاء الحساب بنجاح!');
        }
    }

    private function getServiceTypeName($type)
    {
        $types = [
            'cleaning_company' => 'ورشة تنظيف',
            'carpet_cleaner' => 'تنظيف سجاد',
            'cooking' => 'طبخ منزلي',
            'vegetables' => 'تجهيز خضار',
            'transport' => 'سيارة نقل',
            'worker' => 'عامل',
            'technician' => 'فني',
            'programmer' => 'مبرمج',
            'designer' => 'مصمم جرافيك',
            'photographer' => 'مصور',
            'translator' => 'مترجم',
            'tutor' => 'مدرس خصوصي',
            'cleaner' => 'عامل نظافة',
            'gardener' => 'بستاني',
            'electrician' => 'كهربائي',
            'plumber' => 'سباك',
            'carpenter' => 'نجار',
            'painter' => 'دهان',
            'hairdresser' => 'حلاق',
            'tailor' => 'خياط',
            'mechanic' => 'ميكانيكي',
            'driver' => 'سائق',
            'security' => 'حارس أمن',
            'nurse' => 'ممرض',
            'teacher' => 'معلم',
            'engineer' => 'مهندس',
            'architect' => 'مهندس معماري',
            'accountant' => 'محاسب',
            'lawyer' => 'محامي',
            'consultant' => 'استشاري',
        ];
        return $types[$type] ?? $type;
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'بيانات الدخول غير صحيحة.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
