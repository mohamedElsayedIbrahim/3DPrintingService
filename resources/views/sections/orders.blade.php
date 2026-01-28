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
          @php
            $statusClasses = match($order->status) {
              'pending' => 'bg-yellow-100 text-yellow-700',
              'printing' => 'bg-blue-100 text-blue-700',
              'completed' => 'bg-green-100 text-green-700',
              default => 'bg-gray-100 text-gray-600',
            };
          @endphp

          <div class="bg-white rounded-xl shadow p-6 text-right relative">
            {{-- Header --}}
            <div class="flex justify-between items-center mb-4">
              <span class="text-sm text-gray-500">{{ $order->created_at->format('Y-m-d') }}</span>
              <span class="px-3 py-1 rounded-full text-sm {{ $statusClasses }}">
                {{ ucfirst($order->status) }}
              </span>
            </div>

            {{-- Details --}}
            <p class="mb-2"><strong>المادة:</strong> {{ $order->material }}</p>
            <p class="mb-2"><strong>الكمية:</strong> {{ $order->quantity }}</p>
            <p class="mb-2"><strong>موعد التسليم:</strong> {{ $order->delivery_at ?? 'غير محدد' }}</p>
            <p class="mb-4">
              <strong>التكلفة:</strong>
              <span class="text-purple-600 font-bold">
                @if($order->cost == 0)
                  جارٍ حساب التكلفة
                @else
                  {{ number_format($order->cost, 2) }} ج.م
                @endif
              </span>
            </p>

            {{-- STL / OBJ Viewer --}}
            <div class="relative w-full h-64 mb-4 border rounded">
              <div id="loader-{{ $order->id }}" class="absolute inset-0 flex items-center justify-center bg-white z-10">
                <img src="{{ asset('images/loader.gif') }}" alt="loading" class="w-12 h-12">
              </div>

              <canvas id="stl-canvas-{{ $order->id }}" class="w-full h-full"></canvas>

              {{-- Download Original File --}}
              <a href="{{ route('orders.download', $order) }}"
   class="text-purple-600 hover:underline text-sm mb-2 inline-block">
   تحميل الملف (STL / OBJ)
</a>
            </div>

            {{-- Delete Button (only pending) --}}
            @if($order->status === 'pending')
              <form method="POST" action="{{ route('orders.destroy', $order) }}"
                    onsubmit="return confirm('هل أنت متأكد من حذف الطلب؟')"
                    class="inline-block mt-2">
                @csrf
                @method('DELETE')
                <button class="text-red-600 hover:underline text-sm">حذف</button>
              </form>
            @endif
          </div>

          {{-- Initialize STL Viewer --}}
          <script src="{{ asset('js/stl_viewer/stl_viewer.min.js') }}"></script>
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              const canvas = document.getElementById('stl-canvas-{{ $order->id }}');
              const loaderDiv = document.getElementById('loader-{{ $order->id }}');

              const viewer = new StlViewer(canvas, {
                models: [
                  {
                    filename: "{{ asset('storage/'.$order->file_path) }}",
                    color: '#888888'
                  }
                ],
                background: '#ffffff',
                rotate: true
              });

              // Hide loader after the model is rendered
              setTimeout(() => loaderDiv.style.display = 'none', 1000);
            });
          </script>

        @endforeach
      </div>
    @endif
  </div>
</section>
@endauth
