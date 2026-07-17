<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Job;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ServiceProviderDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $services = Service::where('user_id', $user->id)->count();
        $jobs = Job::where('user_id', $user->id)->count();
        $messages = Message::where('receiver_id', $user->id)->where('is_read', false)->count();
        
        return view('service-provider.dashboard', compact('user', 'services', 'jobs', 'messages'));
    }

    public function myServices()
    {
        $services = Service::where('user_id', Auth::id())->latest()->paginate(10);
        return view('service-provider.services', compact('services'));
    }

    public function createService()
    {
        return view('service-provider.create-service');
    }

    public function storeService(Request $request)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'price_type' => 'required|in:fixed,hourly,daily,weekly,monthly',
            'city' => 'nullable|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $service = new Service();
        $service->user_id = Auth::id();
        $service->service_type = Auth::user()->user_type;
        $service->service_name = $request->service_name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->price_type = $request->price_type;
        $service->city = $request->city;
        $service->phone = Auth::user()->phone;
        $service->is_active = true;

        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('services', 'public');
                $imagePaths[] = $path;
            }
            $service->images = json_encode($imagePaths);
        }

        $service->save();

        return redirect()->route('service-provider.services')->with('success', 'تم إضافة الخدمة بنجاح');
    }

    public function editService($id)
    {
        $service = Service::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('service-provider.edit-service', compact('service'));
    }

    public function updateService(Request $request, $id)
    {
        $service = Service::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        $request->validate([
            'service_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'price_type' => 'required|in:fixed,hourly,daily,weekly,monthly',
            'city' => 'nullable|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $service->service_name = $request->service_name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->price_type = $request->price_type;
        $service->city = $request->city;

        if ($request->hasFile('images')) {
            if ($service->images) {
                $oldImages = json_decode($service->images, true);
                if (is_array($oldImages)) {
                    foreach ($oldImages as $image) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }
            
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('services', 'public');
                $imagePaths[] = $path;
            }
            $service->images = json_encode($imagePaths);
        }

        $service->save();

        return redirect()->route('service-provider.services')->with('success', 'تم تحديث الخدمة بنجاح');
    }

    public function deleteService($id)
    {
        $service = Service::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        if ($service->images) {
            $images = json_decode($service->images, true);
            if (is_array($images)) {
                foreach ($images as $image) {
                    Storage::disk('public')->delete($image);
                }
            }
        }
        
        $service->delete();
        return redirect()->route('service-provider.services')->with('success', 'تم حذف الخدمة بنجاح');
    }

    // إدارة الوظائف
    public function jobs()
    {
        $jobs = Job::where('user_id', Auth::id())->latest()->paginate(10);
        return view('service-provider.jobs', compact('jobs'));
    }

    public function createJob()
    {
        return view('service-provider.create-job');
    }

    public function storeJob(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:full_time,part_time,freelance,temporary',
            'location' => 'nullable|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
            'salary_type' => 'required|in:hourly,daily,weekly,monthly,yearly',
            'expires_at' => 'nullable|date|after:today',
        ]);

        Job::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'location' => $request->location,
            'salary_min' => $request->salary_min,
            'salary_max' => $request->salary_max,
            'salary_type' => $request->salary_type,
            'is_active' => true,
            'expires_at' => $request->expires_at,
        ]);

        return redirect()->route('service-provider.jobs')->with('success', 'تم نشر فرصة العمل بنجاح');
    }

    public function editJob($id)
    {
        $job = Job::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('service-provider.edit-job', compact('job'));
    }

    public function updateJob(Request $request, $id)
    {
        $job = Job::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:full_time,part_time,freelance,temporary',
            'location' => 'nullable|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
            'salary_type' => 'required|in:hourly,daily,weekly,monthly,yearly',
            'is_active' => 'boolean',
            'expires_at' => 'nullable|date',
        ]);

        $job->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'location' => $request->location,
            'salary_min' => $request->salary_min,
            'salary_max' => $request->salary_max,
            'salary_type' => $request->salary_type,
            'is_active' => $request->has('is_active'),
            'expires_at' => $request->expires_at,
        ]);

        return redirect()->route('service-provider.jobs')->with('success', 'تم تحديث فرصة العمل بنجاح');
    }

    public function deleteJob($id)
    {
        $job = Job::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $job->delete();
        return redirect()->route('service-provider.jobs')->with('success', 'تم حذف فرصة العمل بنجاح');
    }

    public function messages()
    {
        $messages = Message::where('receiver_id', Auth::id())
                          ->with('sender')
                          ->latest()
                          ->paginate(20);
        return view('service-provider.messages', compact('messages'));
    }

    public function markMessageRead($id)
    {
        $message = Message::where('id', $id)->where('receiver_id', Auth::id())->firstOrFail();
        $message->is_read = true;
        $message->save();
        return back()->with('success', 'تم قراءة الرسالة');
    }

    public function profile()
    {
        $user = Auth::user();
        $service = Service::where('user_id', $user->id)->first();
        return view('service-provider.profile', compact('user', 'service'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:255',
            'store_name' => 'nullable|string|max:255',
            'store_description' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->city = $request->city;
        $user->store_name = $request->store_name;
        $user->store_description = $request->store_description;

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        // تحديث خدمة المستخدم
        $service = Service::where('user_id', $user->id)->first();
        if ($service) {
            $service->service_name = $request->store_name ?? $service->service_name;
            $service->description = $request->store_description ?? $service->description;
            $service->city = $request->city ?? $service->city;
            $service->phone = $request->phone ?? $service->phone;
            $service->save();
        }

        return back()->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'تم تغيير كلمة المرور بنجاح');
    }
}
