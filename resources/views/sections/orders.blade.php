@auth
<section id="orders" class="py-16 bg-gray-100">
    <div class="container mx-auto px-4 max-w-5xl">
        <h2 class="text-3xl font-bold text-center mb-12">طلباتي</h2>

        @if($orders->isEmpty())
            <div class="bg-white rounded-xl shadow p-6 text-center text-gray-500">
                لا توجد طلبات حالياً
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($orders as $order)
                    <div class="bg-white rounded-xl shadow p-6 text-right">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm text-gray-500">
                                {{ $order->created_at->format('Y-m-d') }}
                            </span>

                            <span class="px-3 py-1 rounded-full text-sm
                                @if($order->status === 'pending') bg-yellow-100 text-yellow-700
                                @elseif($order->status === 'printing') bg-blue-100 text-blue-700
                                @elseif($order->status === 'completed') bg-green-100 text-green-700
                                @else bg-gray-100 text-gray-600
                                @endif
                            ">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>

                        <p class="mb-2">
                            <strong>المادة:</strong> {{ $order->material }}
                        </p>

                        <p class="mb-2">
                            <strong>الكمية:</strong> {{ $order->quantity }}
                        </p>

                        <p class="mb-2">
                            <strong>موعد التسليم:</strong>
                            {{ $order->delivery_at ?? 'غير محدد' }}
                        </p>

                        <p class="mb-4">
                            <strong>التكلفة:</strong>
                            <span class="text-purple-600 font-bold">
                                {{ number_format($order->cost, 2) }} ج.م
                            </span>
                        </p>

                        <div class="flex justify-between items-center">
                            <a href="{{ asset('storage/'.$order->file_path) }}"
                               target="_blank"
                               class="text-purple-600 hover:underline text-sm">
                                عرض الملف
                            </a>

                            {{-- حذف الطلب --}}
                            <form method="POST" action="{{ route('orders.destroy', $order) }}"
                                  onsubmit="return confirm('هل أنت متأكد من حذف الطلب؟')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline text-sm">
                                    حذف
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endauth
