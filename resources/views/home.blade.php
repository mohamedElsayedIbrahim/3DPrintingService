@extends('layouts.app')

@section('title', 'خدمة الطباعة 3D')

@section('content')
    @include('sections.hero')
    @include('sections.services')
    @include('sections.calculator')

    {{-- للمستخدمين المسجلين --}}
    @auth
        @if (auth()->user()->role === 'customer')
            
        @include('sections.order-form')
        @include('sections.orders')
        @endif

    @endauth

    {{-- للمستخدمين غير المسجلين --}}
    @guest
<section id="how-to-order" class="py-16 bg-gray-100">
    <div class="container mx-auto px-4 max-w-4xl text-center">
        <h2 class="text-3xl font-bold mb-12">خطوات تقديم طلب الطباعة 3D</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
            {{-- Step 1 --}}
            <div class="flex items-start space-x-4 md:space-x-6">
                <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-purple-600 text-white rounded-full text-xl font-bold">
                    1
                </div>
                <div>
                    <h3 class="font-semibold text-lg mb-1">سجل دخولك</h3>
                    <p class="text-gray-700">قم بتسجيل دخولك أو إنشاء حساب جديد لتتمكن من تقديم الطلب ومتابعته.</p>
                </div>
            </div>

            {{-- Step 2 --}}
            <div class="flex items-start space-x-4 md:space-x-6">
                <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-purple-600 text-white rounded-full text-xl font-bold">
                    2
                </div>
                <div>
                    <h3 class="font-semibold text-lg mb-1">احصل على تكلفة</h3>
                    <p class="text-gray-700">استخدم حاسبة التكلفة لمعرفة تكلفة مشروعك بدقة قبل تقديم الطلب.</p>
                </div>
            </div>

            {{-- Step 3 --}}
            <div class="flex items-start space-x-4 md:space-x-6">
                <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-purple-600 text-white rounded-full text-xl font-bold">
                    3
                </div>
                <div>
                    <h3 class="font-semibold text-lg mb-1">قم بتقديم الطلب</h3>
                    <p class="text-gray-700">أرسل طلبك بسهولة عبر نموذج الطلب مع رفع ملفات التصميم.</p>
                </div>
            </div>

            {{-- Step 4 --}}
            <div class="flex items-start space-x-4 md:space-x-6">
                <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-purple-600 text-white rounded-full text-xl font-bold">
                    4
                </div>
                <div>
                    <h3 class="font-semibold text-lg mb-1">تتبع الطلبات</h3>
                    <p class="text-gray-700">تابع طلباتك ومراحل تنفيذها بشكل احترافي من حسابك الشخصي.</p>
                </div>
            </div>
        </div>

        <a href="{{ route('login') }}" class="inline-block mt-12 px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
            سجل الآن
        </a>
    </div>
</section>
@endguest

@endsection
