<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'خدمة الطباعة 3D')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap');
        body { font-family: 'Tajawal', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .glass-effect { background: rgba(255,255,255,.95); backdrop-filter: blur(10px); }
        .service-card { transition: all .3s ease; }
        .service-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,.1); }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-50">

@include('components.header')

<main>
    @yield('content')
</main>

@include('components.footer')

@stack('scripts')
</body>
</html>
