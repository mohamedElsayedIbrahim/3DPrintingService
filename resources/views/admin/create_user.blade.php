@extends('layouts.admin')

@section('content')
<div class="flex-1 p-6">
    <h1 class="text-3xl font-bold mb-6">إضافة مشرف جديد</h1>

    <div class="bg-white rounded-xl shadow p-6 max-w-md">
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 mb-1">الاسم</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-1">البريد الإلكتروني</label>
                <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-1">كلمة المرور</label>
                <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-1">تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2" required>
            </div>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">إضافة المشرف</button>
        </form>
    </div>
</div>
@endsection
