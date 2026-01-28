@extends('layouts.app')

@section('title', 'تسجيل الدخول')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">تسجيل الدخول</h2>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-1">البريد الإلكتروني</label>
                <input type="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-1">كلمة المرور</label>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-500" required>
            </div>

            <div class="mb-4 flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="ml-2">
                    تذكرني
                </label>
                <a href="#" class="text-purple-600 hover:underline text-sm">نسيت كلمة المرور؟</a>
            </div>

            <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition">
                تسجيل الدخول
            </button>
        </form>

        <p class="mt-6 text-center text-gray-600 text-sm">
            ليس لديك حساب؟ <a href="{{ route('register') }}" class="text-purple-600 hover:underline">سجل الآن</a>
        </p>
    </div>
</div>
@endsection
