
    {{-- الشريط الجانبي --}}
    <aside class="w-64 bg-white shadow-lg">
        <div class="p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">لوحة الإدارة</h2>
            <nav class="space-y-2">
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->is('admin/dashboard') ? 'bg-gray-200' : '' }}">
                    لوحة التحكم
                </a>
                <a href="{{ route('admin.users') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->is('admin/users') ? 'bg-gray-200' : '' }}">
                    المستخدمون
                </a>
            </nav>
        </div>
    </aside>
