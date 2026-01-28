@extends('layouts.app')

@section('title', 'إنشاء حساب جديد')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">

        <h2 class="text-2xl font-bold mb-6 text-center">
            إنشاء حساب جديد
        </h2>

        {{-- Laravel Errors --}}
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- JS Errors --}}
        <div id="jsErrors" class="hidden mb-4 p-3 bg-red-100 text-red-700 rounded"></div>

        <form id="registerForm" method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            {{-- Name --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-1">
                    الاسم الكامل
                </label>
                <input
                    type="text"
                    name="name"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-500"
                    placeholder="اكتب اسمك بالكامل"
                    required
                >
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-1">
                    البريد الإلكتروني
                </label>
                <input
                    type="email"
                    name="email"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-500"
                    placeholder="example@email.com"
                    required
                >
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-1">
                    كلمة المرور
                </label>
                <input
                    type="password"
                    name="password"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-500"
                    placeholder="********"
                    required
                >
                <p class="text-xs text-gray-500 mt-1">
                    يجب أن تكون 8 أحرف على الأقل
                </p>
            </div>

            {{-- Confirm Password --}}
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-1">
                    تأكيد كلمة المرور
                </label>
                <input
                    type="password"
                    name="password_confirmation"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-500"
                    placeholder="********"
                    required
                >
            </div>

            {{-- Submit --}}
            <button
                type="submit"
                class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition"
            >
                إنشاء الحساب
            </button>
        </form>

        <p class="mt-6 text-center text-gray-600 text-sm">
            لديك حساب بالفعل؟
            <a href="{{ route('login') }}" class="text-purple-600 hover:underline">
                تسجيل الدخول
            </a>
        </p>

    </div>
</div>

{{-- ================= JS VALIDATION ================= --}}
<script>
document.getElementById('registerForm').addEventListener('submit', function (e) {

    const errors = [];
    const errorBox = document.getElementById('jsErrors');

    const name = this.name.value.trim();
    const email = this.email.value.trim();
    const password = this.password.value;
    const confirm = this.password_confirmation.value;

    // reset errors
    errorBox.innerHTML = '';
    errorBox.classList.add('hidden');

    // Name validation
    if (name.length < 3) {
        errors.push('الاسم الكامل يجب ألا يقل عن 3 أحرف');
    }

    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        errors.push('برجاء إدخال بريد إلكتروني صحيح');
    }

    // Password validation
    if (password.length < 8) {
        errors.push('كلمة المرور يجب أن تكون 8 أحرف على الأقل');
    }

    // Confirm password
    if (password !== confirm) {
        errors.push('كلمة المرور وتأكيدها غير متطابقين');
    }

    // Show errors
    if (errors.length > 0) {
        e.preventDefault();

        let html = '<ul class="list-disc pl-5">';
        errors.forEach(error => {
            html += `<li>${error}</li>`;
        });
        html += '</ul>';

        errorBox.innerHTML = html;
        errorBox.classList.remove('hidden');
    }
});
</script>
@endsection
