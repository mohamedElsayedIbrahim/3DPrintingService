@extends('layouts.app')

@section('title', 'إنشاء حساب جديد')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">إنشاء حساب جديد</h2>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-1">الاسم الكامل</label>
                <input type="text" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-1">البريد الإلكتروني</label>
                <input type="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-1">كلمة المرور</label>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-1">تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-500" required>
            </div>

            <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition">
                إنشاء الحساب
            </button>
        </form>

        <p class="mt-6 text-center text-gray-600 text-sm">
            لديك حساب بالفعل؟ <a href="{{ route('login') }}" class="text-purple-600 hover:underline">تسجيل الدخول</a>
        </p>
    </div>
</div>
@endsection
