<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rizk - رزق')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #d4af37;
            --primary-dark: #b8960f;
            --primary-light: #f0d060;
            --secondary-color: #8b5cf6;
            --secondary-dark: #6d28d9;
            --secondary-light: #a78bfa;
            --success-color: #10b981;
            --success-dark: #059669;
            --success-light: #34d399;
            --danger-color: #ef4444;
            --danger-dark: #dc2626;
            --danger-light: #f87171;
            --warning-color: #f59e0b;
            --warning-dark: #d97706;
            --warning-light: #fbbf24;
            --info-color: #06b6d4;
            --info-dark: #0891b2;
            --info-light: #22d3ee;
            --text-primary: #1e293b;
            --text-secondary: #475569;
            --text-muted: #94a3b8;
            --text-light: #cbd5e1;
            --bg-body: #f8fafc;
            --bg-card: #ffffff;
            --bg-navbar: rgba(255, 255, 255, 0.92);
            --bg-footer: #0f172a;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.06);
            --shadow-md: 0 4px 12px rgba(0,0,0,0.08);
            --shadow-lg: 0 8px 30px rgba(0,0,0,0.12);
            --shadow-xl: 0 20px 50px rgba(0,0,0,0.15);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 20px;
            --radius-xl: 28px;
            --brightness: 1;
            --theme-mode: 'light';
        }
        
        /* ===== الوضع المظلم ===== */
        [data-theme="dark"] {
            --primary-color: #f0d060;
            --primary-dark: #d4af37;
            --primary-light: #f7e27a;
            --secondary-color: #a78bfa;
            --secondary-dark: #8b5cf6;
            --text-primary: #f1f5f9;
            --text-secondary: #cbd5e1;
            --text-muted: #94a3b8;
            --text-light: #64748b;
            --bg-body: #0f172a;
            --bg-card: #1e293b;
            --bg-navbar: rgba(15, 23, 42, 0.95);
            --bg-footer: #020617;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.3);
            --shadow-md: 0 4px 12px rgba(0,0,0,0.4);
            --shadow-lg: 0 8px 30px rgba(0,0,0,0.5);
            --shadow-xl: 0 20px 50px rgba(0,0,0,0.6);
        }
        
        /* ===== تطبيق السطوع ===== */
        body {
            filter: brightness(var(--brightness));
            transition: filter 0.2s ease, background-color 0.3s ease, color 0.3s ease;
        }
        
        /* ===== شريط التحكم المتقدم بالسطوع ===== */
        .brightness-container {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 14px;
            background: var(--bg-card);
            border-radius: 30px;
            box-shadow: var(--shadow-sm);
            border: 2px solid rgba(212, 175, 55, 0.15);
            min-width: 200px;
            transition: all 0.3s ease;
        }
        .brightness-container:hover {
            border-color: var(--primary-color);
            box-shadow: var(--shadow-md);
        }
        
        .brightness-container .icon-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .brightness-container .icon-wrapper:hover {
            transform: scale(1.1);
        }
        
        .brightness-container .mode-icon {
            font-size: 1.1rem;
            color: var(--text-muted);
            transition: all 0.3s ease;
        }
        .brightness-container .mode-icon.active-light {
            color: #fbbf24;
        }
        .brightness-container .mode-icon.active-dark {
            color: #818cf8;
        }
        
        .brightness-slider {
            -webkit-appearance: none;
            appearance: none;
            width: 120px;
            height: 6px;
            border-radius: 10px;
            background: linear-gradient(to right, #fbbf24, #f59e0b, #818cf8, #1e293b);
            outline: none;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
        }
        .brightness-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(212, 175, 55, 0.4);
            transition: all 0.3s ease;
            border: 2px solid white;
        }
        .brightness-slider::-webkit-slider-thumb:hover {
            transform: scale(1.15);
            box-shadow: 0 2px 16px rgba(212, 175, 55, 0.6);
        }
        .brightness-slider::-webkit-slider-thumb:active {
            transform: scale(0.95);
        }
        .brightness-slider::-moz-range-thumb {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            cursor: pointer;
            border: 2px solid white;
            box-shadow: 0 2px 10px rgba(212, 175, 55, 0.4);
        }
        .brightness-slider::-moz-range-thumb:hover {
            transform: scale(1.15);
        }
        
        .brightness-value {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-primary);
            min-width: 38px;
            text-align: center;
            font-family: 'Cairo', sans-serif;
        }
        
        /* ===== تأثيرات ===== */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 20px rgba(212, 175, 55, 0.3); }
            50% { box-shadow: 0 0 40px rgba(212, 175, 55, 0.6); }
        }
        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        @keyframes slideIn {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        .animate-fade-up { animation: fadeInUp 0.7s ease forwards; }
        .animate-float { animation: float 4s ease-in-out infinite; }
        .animate-pulse-glow { animation: pulseGlow 2.5s ease-in-out infinite; }
        .animate-slide-in { animation: slideIn 0.5s ease forwards; }
        
        .hover-scale {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .hover-scale:hover {
            transform: scale(1.05) translateY(-6px);
            box-shadow: var(--shadow-lg);
        }
        .hover-lift {
            transition: all 0.4s ease;
        }
        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }
        .hover-glow {
            transition: all 0.4s ease;
        }
        .hover-glow:hover {
            box-shadow: 0 0 30px rgba(212, 175, 55, 0.25);
            transform: translateY(-4px);
        }
        
        * { box-sizing: border-box; }
        
        body {
            font-size: 15px;
            line-height: 1.7;
            background-color: var(--bg-body);
            color: var(--text-primary);
            transition: background-color 0.4s ease, color 0.4s ease, filter 0.3s ease;
            padding-top: 80px;
            font-family: 'Cairo', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: var(--bg-body); }
        ::-webkit-scrollbar-thumb { background: var(--primary-color); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--primary-dark); }
        
        a { color: var(--primary-color); text-decoration: none; transition: color 0.3s ease; }
        a:hover { color: var(--primary-dark); }
        
        .navbar-rizk {
            background: var(--bg-navbar) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 2px solid rgba(212, 175, 55, 0.2);
            box-shadow: var(--shadow-sm);
            padding: 10px 0;
            transition: all 0.4s ease;
        }
        .navbar-rizk.scrolled {
            box-shadow: var(--shadow-md);
            border-bottom-color: var(--primary-color);
        }
        .navbar-rizk .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            font-size: 1.6rem;
            color: var(--text-primary) !important;
            letter-spacing: -0.5px;
        }
        .navbar-rizk .brand-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.3rem;
            animation: float 4s ease-in-out infinite;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }
        .navbar-rizk .brand-text {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark), var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .navbar-rizk .brand-sub {
            font-size: 0.65rem;
            font-weight: 400;
            color: var(--text-muted);
            -webkit-text-fill-color: var(--text-muted);
            display: block;
            margin-top: -4px;
            letter-spacing: 1px;
        }
        .navbar-rizk .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 8px 18px;
            border-radius: var(--radius-sm);
            transition: all 0.3s ease;
            position: relative;
        }
        .navbar-rizk .nav-link::after {
            content: '';
            position: absolute;
            bottom: 2px;
            right: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            transition: all 0.3s ease;
            transform: translateX(50%);
            border-radius: 2px;
        }
        .navbar-rizk .nav-link:hover::after,
        .navbar-rizk .nav-link.active::after {
            width: 60%;
        }
        .navbar-rizk .nav-link:hover {
            color: var(--primary-color) !important;
            background: rgba(212, 175, 55, 0.06);
            transform: translateY(-1px);
        }
        .navbar-rizk .dropdown-menu {
            background: var(--bg-card);
            border: none;
            box-shadow: var(--shadow-lg);
            border-radius: var(--radius-md);
            padding: 8px;
            min-width: 220px;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(212, 175, 55, 0.08);
            margin-top: 8px;
        }
        .navbar-rizk .dropdown-item {
            color: var(--text-secondary);
            border-radius: var(--radius-sm);
            padding: 10px 16px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.9rem;
        }
        .navbar-rizk .dropdown-item i {
            width: 22px;
            color: var(--primary-color);
            transition: all 0.3s ease;
        }
        .navbar-rizk .dropdown-item:hover {
            background: rgba(212, 175, 55, 0.08);
            color: var(--primary-color);
            transform: translateX(6px);
        }
        .navbar-rizk .dropdown-item:hover i { transform: scale(1.2); }
        .navbar-rizk .dropdown-divider {
            border-color: rgba(212, 175, 55, 0.08);
            margin: 6px 0;
        }
        
        .btn-rizk {
            border-radius: var(--radius-md);
            padding: 10px 28px;
            font-weight: 700;
            font-size: 0.95rem;
            border: none;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            font-family: 'Cairo', sans-serif;
            position: relative;
            overflow: hidden;
        }
        .btn-rizk::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255,255,255,0.15);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        .btn-rizk:hover::after {
            width: 300px;
            height: 300px;
        }
        .btn-rizk:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
        }
        .btn-rizk:active { transform: translateY(0px); }
        .btn-rizk-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: #fff;
        }
        .btn-rizk-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
            color: #fff;
        }
        .btn-rizk-secondary {
            background: linear-gradient(135deg, var(--secondary-color), var(--secondary-dark));
            color: #fff;
        }
        .btn-rizk-secondary:hover {
            background: linear-gradient(135deg, var(--secondary-dark), var(--secondary-color));
            color: #fff;
        }
        .btn-rizk-success {
            background: linear-gradient(135deg, var(--success-color), var(--success-dark));
            color: #fff;
        }
        .btn-rizk-success:hover {
            background: linear-gradient(135deg, var(--success-dark), var(--success-color));
            color: #fff;
        }
        .btn-rizk-outline {
            background: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }
        .btn-rizk-outline:hover {
            background: var(--primary-color);
            color: #fff;
            box-shadow: var(--shadow-md);
        }
        .btn-rizk-glow {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: #fff;
            animation: pulseGlow 2.5s ease-in-out infinite;
        }
        .btn-rizk-glow:hover {
            animation: none;
            transform: translateY(-3px) scale(1.02);
        }
        
        .card-rizk {
            background: var(--bg-card);
            border: none;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            height: 100%;
        }
        .card-rizk:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-8px);
        }
        .card-rizk .card-header {
            background: transparent;
            border-bottom: 1px solid rgba(212, 175, 55, 0.08);
            padding: 18px 22px;
            font-weight: 700;
        }
        .card-rizk .card-body { padding: 22px; }
        .card-rizk .card-footer {
            background: transparent;
            border-top: 1px solid rgba(212, 175, 55, 0.06);
            padding: 14px 22px;
        }
        .card-rizk-gold {
            border: 2px solid rgba(212, 175, 55, 0.15);
            background: linear-gradient(135deg, var(--bg-card), rgba(212, 175, 55, 0.03));
        }
        .card-rizk-gold:hover {
            border-color: var(--primary-color);
            box-shadow: 0 0 30px rgba(212, 175, 55, 0.08);
        }
        
        .form-rizk {
            background: var(--bg-card);
            border: 2px solid rgba(212, 175, 55, 0.12);
            border-radius: var(--radius-md);
            padding: 12px 18px;
            color: var(--text-primary);
            transition: all 0.3s ease;
            font-family: 'Cairo', sans-serif;
            width: 100%;
        }
        .form-rizk:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.08);
            outline: none;
        }
        .form-rizk::placeholder { color: var(--text-muted); }
        .form-rizk:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        
        .footer-rizk {
            background: var(--bg-footer);
            color: #94a3b8;
            padding: 50px 0 25px;
            margin-top: 50px;
            border-top: 3px solid var(--primary-color);
            position: relative;
            overflow: hidden;
        }
        .footer-rizk::before {
            content: '';
            position: absolute;
            top: 0;
            right: -50%;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
            animation: gradientMove 3s ease-in-out infinite;
            background-size: 200% 100%;
        }
        .footer-rizk h6 {
            color: #e2e8f0;
            font-weight: 700;
            margin-bottom: 18px;
            font-size: 1.1rem;
        }
        .footer-rizk a {
            color: #94a3b8;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }
        .footer-rizk a:hover {
            color: var(--primary-light);
            transform: translateX(-4px);
        }
        .footer-rizk .footer-social a {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            margin-left: 8px;
        }
        .footer-rizk .footer-social a:hover {
            background: var(--primary-color);
            color: #fff;
            transform: translateY(-4px) scale(1.05);
        }
        
        .badge-rizk {
            padding: 6px 14px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.75rem;
        }
        .badge-rizk-gold {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: #fff;
        }
        
        .section-title-rizk {
            position: relative;
            padding-bottom: 14px;
            margin-bottom: 30px;
            font-weight: 800;
        }
        .section-title-rizk::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 70px;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 4px;
        }
        .section-title-rizk.text-center::after {
            right: 50%;
            transform: translateX(50%);
        }
        .gold-text { color: var(--primary-color); }
        .gold-gradient-text {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .bg-gold-gradient { background: linear-gradient(135deg, var(--primary-color), var(--primary-dark)); }
        .shadow-gold { box-shadow: 0 4px 20px rgba(212, 175, 55, 0.15); }
        
        [data-theme="dark"] .form-rizk {
            border-color: rgba(255,255,255,0.06);
        }
        [data-theme="dark"] .form-rizk:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.1);
        }
        [data-theme="dark"] .navbar-rizk .dropdown-menu {
            border-color: rgba(255,255,255,0.05);
        }
        [data-theme="dark"] .card-rizk-gold {
            border-color: rgba(212, 175, 55, 0.08);
        }
        [data-theme="dark"] .card-rizk-gold:hover {
            border-color: var(--primary-color);
        }
        
        /* ===== استجابة ===== */
        @media (max-width: 992px) {
            body { padding-top: 72px; }
            .navbar-rizk .navbar-brand { font-size: 1.3rem; }
            .navbar-rizk .brand-icon { width: 36px; height: 36px; font-size: 1rem; }
            .brightness-slider { width: 80px; }
            .brightness-container { min-width: 160px; padding: 5px 10px; }
        }
        @media (max-width: 768px) {
            body { padding-top: 64px; font-size: 14px; }
            .navbar-rizk { padding: 8px 0; }
            .navbar-rizk .navbar-brand { font-size: 1.1rem; }
            .navbar-rizk .brand-icon { width: 32px; height: 32px; font-size: 0.9rem; }
            .navbar-rizk .brand-sub { font-size: 0.55rem; }
            .navbar-rizk .nav-link { padding: 6px 14px; font-size: 0.85rem; }
            .btn-rizk { padding: 8px 20px; font-size: 0.85rem; }
            .card-rizk .card-body { padding: 16px; }
            .section-title-rizk { font-size: 1.3rem; }
            .footer-rizk { padding: 30px 0 15px; }
            .brightness-slider { width: 60px; }
            .brightness-container { min-width: 140px; padding: 4px 8px; }
            .brightness-value { font-size: 0.7rem; min-width: 30px; }
            .brightness-container .icon-wrapper { width: 24px; height: 24px; }
            .brightness-container .mode-icon { font-size: 0.9rem; }
        }
        @media (max-width: 576px) {
            body { padding-top: 56px; font-size: 13px; }
            .container { padding-left: 12px; padding-right: 12px; }
            .brightness-slider { width: 50px; }
            .brightness-container { min-width: 120px; padding: 3px 6px; gap: 6px; }
            .brightness-value { font-size: 0.65rem; min-width: 26px; }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-rizk fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <div class="brand-icon"><i class="fas fa-gem"></i></div>
                <div>
                    <span class="brand-text">Rizk</span>
                    <span class="brand-sub">رزق</span>
                </div>
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                            <i class="fas fa-home me-1"></i>الرئيسية
                        </a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('products*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-box me-1"></i>المنتجات
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/products') }}"><i class="fas fa-th me-2"></i>جميع المنتجات</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ url('/products/category/clothes') }}"><i class="fas fa-tshirt me-2"></i>ملابس</a></li>
                            <li><a class="dropdown-item" href="{{ url('/products/category/electronics') }}"><i class="fas fa-mobile-alt me-2"></i>إلكترونيات</a></li>
                            <li><a class="dropdown-item" href="{{ url('/products/category/home') }}"><i class="fas fa-home me-2"></i>أدوات منزلية</a></li>
                            <li><a class="dropdown-item" href="{{ url('/products/category/food') }}"><i class="fas fa-apple-alt me-2"></i>بقالة</a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('discounts*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-tag me-1"></i>التخفيضات
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/discounts') }}"><i class="fas fa-th me-2"></i>جميع التخفيضات</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ url('/discounts/category/clothes') }}"><i class="fas fa-tshirt me-2"></i>تخفيضات الملابس</a></li>
                            <li><a class="dropdown-item" href="{{ url('/discounts/category/electronics') }}"><i class="fas fa-mobile-alt me-2"></i>تخفيضات الإلكترونيات</a></li>
                            <li><a class="dropdown-item" href="{{ url('/discounts/category/home') }}"><i class="fas fa-home me-2"></i>تخفيضات الأدوات المنزلية</a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('merchants*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-store me-1"></i>التجار
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/merchants') }}"><i class="fas fa-th me-2"></i>جميع التجار</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ url('/merchants/category/clothes') }}"><i class="fas fa-tshirt me-2"></i>تجار الملابس</a></li>
                            <li><a class="dropdown-item" href="{{ url('/merchants/category/electronics') }}"><i class="fas fa-mobile-alt me-2"></i>تجار الإلكترونيات</a></li>
                            <li><a class="dropdown-item" href="{{ url('/merchants/category/home') }}"><i class="fas fa-home me-2"></i>تجار الأدوات المنزلية</a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('used-products*') ? 'active' : '' }}" href="{{ url('/used-products') }}">
                            <i class="fas fa-recycle me-1"></i>متجر المستعمل
                        </a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('services*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-concierge-bell me-1"></i>خدمات
                        </a>
                        <ul class="dropdown-menu">
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
                
                <ul class="navbar-nav ms-auto align-items-center gap-2">
                    <!-- ===== شريط التحكم المتقدم بالسطوع ===== -->
                    <li class="nav-item">
                        <div class="brightness-container" id="brightnessContainer">
                            <div class="icon-wrapper" id="modeToggle" title="تبديل الوضع">
                                <i class="fas fa-sun mode-icon active-light" id="modeIcon"></i>
                            </div>
                            <input type="range" min="0" max="100" value="70" class="brightness-slider" id="brightnessSlider">
                            <span class="brightness-value" id="brightnessValue">70%</span>
                        </div>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-search"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" style="min-width: 300px; padding: 16px;">
                            <li>
                                <form method="GET" action="{{ route('search.products') }}">
                                    <div class="input-group">
                                        <input type="text" name="q" class="form-control form-rizk" placeholder="ابحث عن أي شيء...">
                                        <button class="btn btn-rizk-primary" type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <div class="d-grid gap-2">
                                    <a href="{{ route('search.products') }}" class="btn btn-sm btn-rizk-outline">🔍 بحث في المنتجات</a>
                                    <a href="{{ route('search.merchants') }}" class="btn btn-sm btn-rizk-outline">🏪 بحث في التجار</a>
                                    <a href="{{ route('search.discounts') }}" class="btn btn-sm btn-rizk-outline">🏷️ بحث في التخفيضات</a>
                                    <a href="{{ route('search.used-products') }}" class="btn btn-sm btn-rizk-outline">♻️ بحث في المستعمل</a>
                                    <a href="{{ route('search.services') }}" class="btn btn-sm btn-rizk-outline">🛎️ بحث في الخدمات</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    
                    @auth
                        @if(auth()->user()->user_type === 'merchant')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-crown me-1"></i>لوحة التاجر
                                </a>
                                <ul class="dropdown-menu animated-card">
                                    <li><a class="dropdown-item" href="{{ route('merchant.dashboard') }}"><i class="fas fa-chart-line me-2"></i>لوحة التحكم</a></li>
                                    <li><a class="dropdown-item" href="{{ route('merchant.products') }}"><i class="fas fa-box me-2"></i>منتجاتي</a></li>
                                    <li><a class="dropdown-item" href="{{ route('merchant.discounts') }}"><i class="fas fa-tag me-2"></i>تخفيضاتي</a></li>
                                    <li><a class="dropdown-item" href="{{ route('merchant.jobs') }}"><i class="fas fa-briefcase me-2"></i>فرص العمل</a></li>
                                    <li><a class="dropdown-item" href="{{ route('merchant.messages') }}"><i class="fas fa-envelope me-2"></i>الرسائل</a></li>
                                    <li><a class="dropdown-item" href="{{ route('merchant.profile') }}"><i class="fas fa-user me-2"></i>الملف الشخصي</a></li>
                                </ul>
                            </li>
                        @endif

                        @if(auth()->user()->isServiceProvider())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-concierge-bell me-1"></i>لوحة الخدمات
                                </a>
                                <ul class="dropdown-menu animated-card">
                                    <li><a class="dropdown-item" href="{{ route('service-provider.dashboard') }}"><i class="fas fa-chart-line me-2"></i>لوحة التحكم</a></li>
                                    <li><a class="dropdown-item" href="{{ route('service-provider.services') }}"><i class="fas fa-list me-2"></i>خدماتي</a></li>
                                    <li><a class="dropdown-item" href="{{ route('service-provider.services.create') }}"><i class="fas fa-plus me-2"></i>إضافة خدمة</a></li>
                                    <li><a class="dropdown-item" href="{{ route('service-provider.jobs') }}"><i class="fas fa-briefcase me-2"></i>فرص العمل</a></li>
                                    <li><a class="dropdown-item" href="{{ route('service-provider.jobs.create') }}"><i class="fas fa-plus me-2"></i>نشر فرصة عمل</a></li>
                                    <li><a class="dropdown-item" href="{{ route('service-provider.messages') }}"><i class="fas fa-envelope me-2"></i>الرسائل</a></li>
                                    <li><a class="dropdown-item" href="{{ route('service-provider.profile') }}"><i class="fas fa-user me-2"></i>الملف الشخصي</a></li>
                                </ul>
                            </li>
                        @endif

                        @if(auth()->user()->user_type === 'user')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user me-1"></i>حسابي
                                </a>
                                <ul class="dropdown-menu animated-card">
                                    <li><a class="dropdown-item" href="{{ route('user.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>لوحتي</a></li>
                                    <li><a class="dropdown-item" href="{{ route('user.products') }}"><i class="fas fa-shopping-bag me-2"></i>منتجاتي المستعملة</a></li>
                                    <li><a class="dropdown-item" href="{{ route('user.products.create') }}"><i class="fas fa-plus me-2"></i>إضافة منتج</a></li>
                                    <li><a class="dropdown-item" href="{{ route('user.messages') }}"><i class="fas fa-comments me-2"></i>الرسائل</a></li>
                                    <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="fas fa-user me-2"></i>الملف الشخصي</a></li>
                                </ul>
                            </li>
                        @endif

                        @if(auth()->user()->user_type === 'admin')
                            <li class="nav-item">
                                <a class="nav-link fw-semibold" href="{{ url('/admin/dashboard') }}"><i class="fas fa-shield-alt me-1"></i>لوحة المسؤول</a>
                            </li>
                        @endif
                        
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
    
    <!-- عرض رسائل التنبيه -->
    <div class="container mt-2">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show py-2" role="alert" style="border-radius: var(--radius-md);">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show py-2" role="alert" style="border-radius: var(--radius-md);">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>
    
    <!-- المحتوى -->
    <main>@yield('content')</main>
    
    <!-- الفوتر -->
    <footer class="footer-rizk">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="brand-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, var(--primary-color), var(--primary-dark)); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 1.4rem;">
                            <i class="fas fa-gem"></i>
                        </div>
                        <div>
                            <h5 style="color: #fff; font-weight: 800; margin: 0;">Rizk</h5>
                            <small style="color: var(--primary-light);">رزق</small>
                        </div>
                    </div>
                    <p class="small" style="color: #94a3b8; line-height: 1.8;">منصة شاملة لبيع وشراء المنتجات الجديدة والمستعملة مع أفضل العروض والتخفيضات والخدمات المتنوعة</p>
                    <div class="footer-social mt-3">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                    <h6>روابط سريعة</h6>
                    <ul class="list-unstyled small" style="line-height: 2.2;">
                        <li><a href="{{ route('about') }}">عن الموقع</a></li>
                        <li><a href="{{ route('contact') }}">اتصل بنا</a></li>
                        <li><a href="{{ route('privacy') }}">سياسة الخصوصية</a></li>
                        <li><a href="{{ route('terms') }}">شروط الاستخدام</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-4 mb-4 mb-md-0">
                    <h6>الأقسام</h6>
                    <ul class="list-unstyled small" style="line-height: 2.2;">
                        <li><a href="{{ url('/products') }}">المنتجات</a></li>
                        <li><a href="{{ url('/merchants') }}">التجار</a></li>
                        <li><a href="{{ url('/discounts') }}">التخفيضات</a></li>
                        <li><a href="{{ url('/used-products') }}">المستعمل</a></li>
                        <li><a href="{{ url('/services') }}">الخدمات</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-4">
                    <h6>معلومات الاتصال</h6>
                    <ul class="list-unstyled small" style="line-height: 2.2;">
                        <li><i class="fas fa-phone gold-text me-2"></i> +90 555 123 4567</li>
                        <li><i class="fas fa-envelope gold-text me-2"></i> info@rizk.com</li>
                        <li><i class="fas fa-map-marker-alt gold-text me-2"></i> اسطنبول، تركيا</li>
                        <li><i class="fas fa-clock gold-text me-2"></i> 09:00 - 18:00</li>
                    </ul>
                </div>
            </div>
            
            <hr class="my-4" style="border-color: rgba(255,255,255,0.06);">
            
            <div class="text-center small" style="color: #64748b;">
                &copy; {{ date('Y') }} <span class="gold-text">Rizk</span> - جميع الحقوق محفوظة
            </div>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // ===== التحكم المتقدم بالسطوع - من الفاتح إلى المظلم =====
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.getElementById('brightnessSlider');
            const valueDisplay = document.getElementById('brightnessValue');
            const modeIcon = document.getElementById('modeIcon');
            const modeToggle = document.getElementById('modeToggle');
            const body = document.body;
            const html = document.documentElement;
            
            // ===== تحميل الإعدادات المحفوظة =====
            const savedBrightness = localStorage.getItem('brightness');
            const savedTheme = localStorage.getItem('theme');
            
            // ===== تطبيق الوضع المحفوظ =====
            if (savedTheme === 'dark') {
                html.setAttribute('data-theme', 'dark');
                modeIcon.className = 'fas fa-moon mode-icon active-dark';
            } else {
                html.removeAttribute('data-theme');
                modeIcon.className = 'fas fa-sun mode-icon active-light';
            }
            
            // ===== تطبيق السطوع المحفوظ =====
            if (savedBrightness) {
                const value = parseInt(savedBrightness);
                slider.value = value;
                // من 0.5 إلى 1.5 (0% = أغمق، 100% = أفتح)
                const brightness = 0.5 + (value / 100);
                body.style.setProperty('--brightness', brightness);
                valueDisplay.textContent = value + '%';
            } else {
                // القيمة الافتراضية 70%
                slider.value = 70;
                body.style.setProperty('--brightness', 1.2);
                valueDisplay.textContent = '70%';
            }
            
            // ===== تحديث السطوع عند السحب =====
            slider.addEventListener('input', function() {
                const value = parseInt(this.value);
                // من 0.5 إلى 1.5 (0% = أغمق، 100% = أفتح)
                const brightness = 0.5 + (value / 100);
                
                // تطبيق السطوع
                body.style.setProperty('--brightness', brightness);
                valueDisplay.textContent = value + '%';
                
                // حفظ في localStorage
                localStorage.setItem('brightness', value);
                
                // تبديل الوضع تلقائياً بناءً على مستوى السطوع
                if (value < 30) {
                    // سطوع منخفض → الوضع المظلم
                    html.setAttribute('data-theme', 'dark');
                    modeIcon.className = 'fas fa-moon mode-icon active-dark';
                    localStorage.setItem('theme', 'dark');
                } else if (value > 60) {
                    // سطوع عالي → الوضع الفاتح
                    html.removeAttribute('data-theme');
                    modeIcon.className = 'fas fa-sun mode-icon active-light';
                    localStorage.setItem('theme', 'light');
                }
                // بين 30 و 60: يبقى الوضع الحالي
            });
            
            // ===== تبديل الوضع (نقر على الأيقونة) =====
            modeToggle.addEventListener('click', function() {
                const currentTheme = html.getAttribute('data-theme');
                const currentValue = parseInt(slider.value);
                
                if (currentTheme === 'dark') {
                    // التبديل إلى الوضع الفاتح + زيادة السطوع
                    html.removeAttribute('data-theme');
                    modeIcon.className = 'fas fa-sun mode-icon active-light';
                    localStorage.setItem('theme', 'light');
                    
                    // زيادة السطوع إلى 80%
                    slider.value = 80;
                    body.style.setProperty('--brightness', 1.3);
                    valueDisplay.textContent = '80%';
                    localStorage.setItem('brightness', 80);
                } else {
                    // التبديل إلى الوضع المظلم + تقليل السطوع
                    html.setAttribute('data-theme', 'dark');
                    modeIcon.className = 'fas fa-moon mode-icon active-dark';
                    localStorage.setItem('theme', 'dark');
                    
                    // تقليل السطوع إلى 25%
                    slider.value = 25;
                    body.style.setProperty('--brightness', 0.75);
                    valueDisplay.textContent = '25%';
                    localStorage.setItem('brightness', 25);
                }
            });
            
            console.log('🌟 Brightness Control Loaded! (0.5 → 1.5)');
        });
    </script>
    
    @stack('scripts')
</body>
</html>
