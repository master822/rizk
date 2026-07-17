<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'phone',
        'city',
        'is_active',
        'store_name',
        'store_category',
        'store_description',
        'store_phone',
        'store_city',
        'product_limit',
        'avatar',
        'store_logo',
        'address',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function isMerchant()
    {
        return $this->user_type === 'merchant';
    }

    public function isUser()
    {
        return $this->user_type === 'user';
    }

    public function isAdmin()
    {
        return $this->user_type === 'admin';
    }

    public function isServiceProvider()
    {
        $serviceTypes = [
            'cooking', 'vegetables', 'transport', 'worker', 
            'technician', 'programmer', 'designer', 'photographer',
            'translator', 'tutor', 'cleaner', 'gardener',
            'electrician', 'plumber', 'carpenter', 'painter',
            'hairdresser', 'tailor', 'mechanic', 'driver',
            'security', 'nurse', 'teacher', 'engineer',
            'architect', 'accountant', 'lawyer', 'consultant',
            'cleaning_company', 'carpet_cleaner'
        ];
        return in_array($this->user_type, $serviceTypes);
    }

    public function canPostJobs()
    {
        return $this->isMerchant() || $this->isServiceProvider();
    }

    public function canSellUsed()
    {
        return $this->isUser();
    }
}
