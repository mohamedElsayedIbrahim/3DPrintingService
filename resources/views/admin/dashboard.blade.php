@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-100">

    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow-lg">
        <div class="p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">لوحة الإدارة</h2>
            <nav class="space-y-2">
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->is('admin/dashboard') ? 'bg-gray-200' : '' }}">
                    Dashboard
                </a>
                <a href="#" class="block px-4 py-2 rounded hover:bg-gray-200">Users</a>
            </nav>
        </div>
    </aside>

    {{-- Main content --}}
    <div class="flex-1 p-6">
        <header class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">لوحة التحكم</h1>
            <div class="flex items-center space-x-4">
                <span class="text-gray-700">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 hover:underline text-sm">Logout</button>
                </form>
            </div>
        </header>

        {{-- Orders Table --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-2xl font-bold mb-4">الطلبات الأخيرة</h2>

            @if($orders->isEmpty())
                <p class="text-gray-500">لا توجد طلبات حتى الآن.</p>
            @else
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-right text-sm font-medium text-gray-700">ID</th>
                            <th class="px-4 py-2 text-right text-sm font-medium text-gray-700">الاسم</th>
                            <th class="px-4 py-2 text-right text-sm font-medium text-gray-700">المادة</th>
                            <th class="px-4 py-2 text-right text-sm font-medium text-gray-700">الكمية</th>
                            <th class="px-4 py-2 text-right text-sm font-medium text-gray-700">الحالة</th>
                            <th class="px-4 py-2 text-right text-sm font-medium text-gray-700">التاريخ</th>
                            <th class="px-4 py-2 text-center text-sm font-medium text-gray-700">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($orders as $order)
                        @php
                            $statusClasses = match($order->status) {
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'printing' => 'bg-blue-100 text-blue-700',
                                'completed' => 'bg-green-100 text-green-700',
                                default => 'bg-gray-100 text-gray-600',
                            };
                        @endphp
                        <tr>
                            <td class="px-4 py-2 text-right">{{ $order->id }}</td>
                            <td class="px-4 py-2 text-right">{{ $order->full_name }}</td>
                            <td class="px-4 py-2 text-right">{{ $order->material }}</td>
                            <td class="px-4 py-2 text-right">{{ $order->quantity }}</td>
                            <td class="px-4 py-2 text-right">
                                <span class="px-2 py-1 rounded text-sm {{ $statusClasses }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-right">{{ $order->created_at->format('Y-m-d') }}</td>
                            <td class="px-4 py-2 text-center space-x-2">
                                <a href="{{ route('orders.download', $order) }}" class="text-purple-600 hover:underline text-sm">Download</a>
                                <form method="POST" action="{{ route('orders.destroy', $order) }}" class="inline-block" onsubmit="return confirm('هل أنت متأكد؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
