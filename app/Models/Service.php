<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_type',
        'service_name',
        'description',
        'price_type',
        'price',
        'is_active',
        'images',
        'city',
        'phone'
    ];

    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getServiceTypeNameAttribute()
    {
        $types = [
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

        return $types[$this->service_type] ?? $this->service_type;
    }
}
