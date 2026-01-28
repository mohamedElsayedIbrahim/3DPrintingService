@extends('layouts.admin')

@section('content')

    {{-- المحتوى الرئيسي --}}
    <div class="flex-1 p-6">
        <header class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">المستخدمون</h1>
            <div class="flex items-center space-x-4">
                <span class="text-gray-700">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 hover:underline text-sm">تسجيل الخروج</button>
                </form>
            </div>
        </header>

        {{-- زر إضافة Admin جديد --}}
        <div class="mb-4">
            <a href="{{ route('admin.users.create') }}"
               class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                إضافة مشرف جديد
            </a>
        </div>

        {{-- جدول المستخدمين --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-2xl font-bold mb-4">كل المشرفين</h2>

            @if($admins->isEmpty())
                <p class="text-gray-500">لا يوجد مستخدمون من نوع Admin حتى الآن.</p>
            @else
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-right text-sm font-medium text-gray-700">ID</th>
                            <th class="px-4 py-2 text-right text-sm font-medium text-gray-700">الاسم</th>
                            <th class="px-4 py-2 text-right text-sm font-medium text-gray-700">البريد الإلكتروني</th>
                            <th class="px-4 py-2 text-right text-sm font-medium text-gray-700">تاريخ الإنشاء</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($admins as $admin)
                        <tr>
                            <td class="px-4 py-2 text-right">{{ $admin->id }}</td>
                            <td class="px-4 py-2 text-right">{{ $admin->name }}</td>
                            <td class="px-4 py-2 text-right">{{ $admin->email }}</td>
                            <td class="px-4 py-2 text-right">{{ $admin->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

@endsection
