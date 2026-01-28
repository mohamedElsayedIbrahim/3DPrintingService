<header class="gradient-bg text-white shadow-lg">
    <div class="container mx-auto px-4 py-6 flex justify-between items-center">
        {{-- Logo --}}
        <div class="flex items-center space-x-reverse space-x-4">
            <i class="fas fa-cube text-3xl"></i>
            <div>
                <h1 class="text-2xl font-bold">طباعة 3D احترافية</h1>
                <p class="text-sm opacity-90">نظام طلب الخدمات الذكي</p>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="hidden md:flex items-center space-x-reverse space-x-6">
            <a href="#services" class="hover:opacity-80 transition">الخدمات</a>
            <a href="#calculator" class="hover:opacity-80 transition">حاسبة التكلفة</a>

            {{-- يظهروا فقط لو المستخدم مسجل --}}
            @auth
        @if (auth()->user()->role === 'customer')
          
                <a href="#order" class="hover:opacity-80 transition">طلب جديد</a>
                <a href="#orders" class="hover:opacity-80 transition">طلباتي</a>
                @endif
            @endauth
        </nav>

        {{-- Auth buttons --}}
        <div class="flex items-center space-x-reverse space-x-4">
            {{-- لو Guest --}}
            @guest
                <a href="{{ route('login') }}"
                   class="px-4 py-2 bg-white text-purple-600 rounded-lg font-semibold hover:bg-gray-100 transition">
                    تسجيل الدخول
                </a>

                <a href="{{ route('register') }}"
                   class="px-4 py-2 border border-white rounded-lg hover:bg-white hover:text-purple-600 transition">
                    إنشاء حساب
                </a>
            @endguest

            {{-- لو Auth --}}
            @auth
                <span class="text-sm opacity-90">
                    مرحباً، {{ auth()->user()->name }}
                </span>

                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('dashboard') }}"
                   class="px-4 py-2 bg-white text-purple-600 rounded-lg font-semibold hover:bg-gray-100 transition">
                    لوحة التحكم
                </a>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 bg-red-500 rounded-lg hover:bg-red-600 transition">
                        تسجيل الخروج
                    </button>
                </form>
            @endauth
        </div>
    </div>
</header>
