<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function contactMerchantForm($productId)
    {
        $product = Product::findOrFail($productId);
        
        if ($product->user_id == Auth::id()) {
            return redirect()->route('products.show', $product->id)
                            ->with('error', 'لا يمكنك مراسلة نفسك!');
        }
        
        return view('messages.contact', compact('product'));
    }

    public function contactMerchant(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        
        if ($product->user_id == Auth::id()) {
            return redirect()->route('products.show', $product->id)
                            ->with('error', 'لا يمكنك مراسلة نفسك!');
        }
        
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $product->user_id,
            'product_id' => $product->id,
            'message' => $request->message,
            'is_read' => false,
        ]);

        // إرسال إشعار للمستلم
        try {
            Notification::create([
                'user_id' => $product->user_id,
                'sender_id' => Auth::id(),
                'type' => 'message',
                'title' => 'رسالة جديدة',
                'message' => 'لديك رسالة جديدة من ' . Auth::user()->name . ' بخصوص منتج: ' . $product->name,
                'link' => route('messages.conversation', Auth::id()),
                'is_read' => false,
            ]);
        } catch (\Exception $e) {
            // إذا فشل الإشعار، نستمر دون إشعار
        }

        return redirect()->route('products.show', $product->id)
                        ->with('success', 'تم إرسال رسالتك بنجاح!');
    }

    // ===== دوال التواصل لفرص العمل =====
    public function contactJobForm($jobId)
    {
        $job = Job::findOrFail($jobId);
        
        if ($job->user_id == Auth::id()) {
            return redirect()->route('jobs.show', $job->id)
                            ->with('error', 'لا يمكنك مراسلة نفسك!');
        }
        
        return view('messages.contact-job', compact('job'));
    }

    public function contactJob(Request $request, $jobId)
    {
        $job = Job::findOrFail($jobId);
        
        if ($job->user_id == Auth::id()) {
            return redirect()->route('jobs.show', $job->id)
                            ->with('error', 'لا يمكنك مراسلة نفسك!');
        }
        
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $job->user_id,
            'message' => 'بخصوص فرصة العمل: ' . $job->title . "\n\n" . $request->message,
            'is_read' => false,
        ]);

        // إرسال إشعار للمستلم
        try {
            Notification::create([
                'user_id' => $job->user_id,
                'sender_id' => Auth::id(),
                'type' => 'message',
                'title' => 'رسالة جديدة بخصوص فرصة عمل',
                'message' => 'لديك رسالة جديدة من ' . Auth::user()->name . ' بخصوص فرصة العمل: ' . $job->title,
                'link' => route('messages.conversation', Auth::id()),
                'is_read' => false,
            ]);
        } catch (\Exception $e) {
            // إذا فشل الإشعار، نستمر دون إشعار
        }

        return redirect()->route('jobs.show', $job->id)
                        ->with('success', 'تم إرسال رسالتك بنجاح!');
    }

    // ===== دوال المحادثات =====
    public function inbox()
    {
        $messages = Message::where('receiver_id', Auth::id())
                          ->with(['sender', 'product'])
                          ->orderBy('created_at', 'desc')
                          ->paginate(20);
        
        $unreadCount = Message::where('receiver_id', Auth::id())
                              ->where('is_read', false)
                              ->count();
        
        return view('messages.inbox', compact('messages', 'unreadCount'));
    }

    public function sent()
    {
        $messages = Message::where('sender_id', Auth::id())
                          ->with(['receiver', 'product'])
                          ->orderBy('created_at', 'desc')
                          ->paginate(20);
        
        return view('messages.sent', compact('messages'));
    }

    public function showConversation($userId)
    {
        $messages = Message::where(function($query) use ($userId) {
                            $query->where('sender_id', Auth::id())
                                  ->where('receiver_id', $userId);
                        })->orWhere(function($query) use ($userId) {
                            $query->where('sender_id', $userId)
                                  ->where('receiver_id', Auth::id());
                        })->orderBy('created_at', 'asc')
                        ->get();
        
        Message::where('sender_id', $userId)
               ->where('receiver_id', Auth::id())
               ->where('is_read', false)
               ->update(['is_read' => true]);
        
        $otherUser = \App\Models\User::findOrFail($userId);
        
        return view('messages.conversation', compact('messages', 'otherUser'));
    }

    public function sendMessageInConversation(Request $request, $userId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $userId,
            'message' => $request->message,
            'is_read' => false,
        ]);

        return redirect()->route('messages.conversation', $userId)
                        ->with('success', 'تم إرسال الرسالة بنجاح');
    }

    public function markAsRead($id)
    {
        $message = Message::where('id', $id)->where('receiver_id', Auth::id())->firstOrFail();
        $message->is_read = true;
        $message->save();
        
        return back()->with('success', 'تم تحديد الرسالة كمقروءة');
    }

    public function deleteMessage($id)
    {
        $message = Message::where('id', $id)
                         ->where(function($query) {
                             $query->where('sender_id', Auth::id())
                                   ->orWhere('receiver_id', Auth::id());
                         })->firstOrFail();
        
        $message->delete();
        
        return back()->with('success', 'تم حذف الرسالة بنجاح');
    }

    public function clearConversation($userId)
    {
        Message::where(function($query) use ($userId) {
                    $query->where('sender_id', Auth::id())
                          ->where('receiver_id', $userId);
                })->orWhere(function($query) use ($userId) {
                    $query->where('sender_id', $userId)
                          ->where('receiver_id', Auth::id());
                })->delete();
        
        return redirect()->route('messages.inbox')
                        ->with('success', 'تم مسح المحادثة بنجاح');
    }
}
