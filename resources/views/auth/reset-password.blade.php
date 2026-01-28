@extends('layouts.app')

@section('title', 'إعادة تعيين كلمة المرور')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">إعادة تعيين كلمة المرور</h2>

        {{-- عرض الأخطاء --}}
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- رسالة نجاح --}}
        @if (session('status'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-1">البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ $email ?? old('email') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-500" required readonly>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-1">كلمة المرور الجديدة</label>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-1">تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-500" required>
            </div>

            <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition">
                إعادة تعيين كلمة المرور
            </button>
        </form>

        <p class="mt-6 text-center text-gray-600 text-sm">
            العودة لتسجيل الدخول؟ <a href="{{ route('login') }}" class="text-purple-600 hover:underline">تسجيل الدخول</a>
        </p>
    </div>
</div>
@endsection
