<section id="order" class="py-16">
    <div class="container mx-auto px-4 max-w-4xl">
        <h2 class="text-3xl font-bold text-center mb-12">طلب جديد</h2>

        <form
            id="orderForm"
            action="{{ route('orders.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="bg-white p-8 rounded-xl shadow space-y-6"
        >
            @csrf

            {{-- Full Name --}}
<div>
    <label class="block text-sm font-medium mb-1">الاسم الكامل</label>

    <input
        type="text"
        value="{{ auth()->user()->name }}"
        disabled
        class="w-full border p-3 rounded bg-gray-100 text-gray-600 cursor-not-allowed"
    >

    <input type="hidden" name="full_name" value="{{ auth()->user()->name }}">
</div>

{{-- Email --}}
<div>
    <label class="block text-sm font-medium mb-1">البريد الإلكتروني</label>

    <input
        type="email"
        value="{{ auth()->user()->email }}"
        disabled
        class="w-full border p-3 rounded bg-gray-100 text-gray-600 cursor-not-allowed"
    >

    <input type="hidden" name="email" value="{{ auth()->user()->email }}">
</div>


            <input name="phone" placeholder="رقم الجوال" class="w-full border p-3 rounded">
            <textarea name="description" placeholder="وصف المشروع" class="w-full border p-3 rounded"></textarea>

            <select name="material" class="w-full border p-3 rounded">
                <option value="PLA">PLA</option>
                <option value="ABS">ABS</option>
                <option value="PETG">PETG</option>
                <option value="Resin">Resin</option>
            </select>

            <input name="quantity" type="number" value="1" class="w-full border p-3 rounded">
            <input name="delivery_at" type="date" class="w-full border p-3 rounded">
            <textarea name="notes" placeholder="ملاحظات" class="w-full border p-3 rounded"></textarea>

            {{-- File upload --}}
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    ملف التصميم (STL / OBJ)
                </label>

                <div
                    class="flex items-center justify-between border-2 border-dashed rounded-lg p-4 cursor-pointer hover:border-purple-500 transition"
                    onclick="document.getElementById('fileInput').click()"
                >
                    <span id="fileName" class="text-gray-500">
                        لم يتم اختيار ملف
                    </span>

                    <span class="bg-purple-600 text-white px-4 py-2 rounded text-sm">
                        اختيار ملف
                    </span>
                </div>

                <p class="text-xs text-gray-500">
                    الصيغ المدعومة: STL, OBJ — الحد الأقصى: 20MB
                </p>

                <input
                    id="fileInput"
                    name="file"
                    type="file"
                    accept=".stl,.obj"
                    class="hidden"
                    onchange="showFileName(this)"
                />
            </div>

            <button class="w-full bg-purple-600 text-white py-3 rounded">
                إرسال الطلب
            </button>
        </form>
    </div>
</section>

{{-- ================= MODAL ================= --}}
<div id="modalOverlay" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-lg max-w-md w-full mx-4 p-6 relative animate-scale">
        <button
            onclick="closeModal()"
            class="absolute top-3 left-3 text-gray-400 hover:text-gray-600 text-xl"
        >
            &times;
        </button>

        <h3 id="modalTitle" class="text-lg font-bold mb-4"></h3>

        <div id="modalContent" class="text-sm"></div>

        <button
            onclick="closeModal()"
            class="mt-6 w-full bg-purple-600 text-white py-2 rounded hover:bg-purple-700"
        >
            إغلاق
        </button>
    </div>
</div>

<style>
@keyframes scale {
    from { transform: scale(.9); opacity: 0 }
    to { transform: scale(1); opacity: 1 }
}
.animate-scale {
    animation: scale .2s ease-out;
}
</style>

@push('scripts')
<script>
// ---------- File name preview ----------
function showFileName(input) {
    const fileNameSpan = document.getElementById('fileName');

    if (!input.files.length) {
        fileNameSpan.textContent = 'لم يتم اختيار ملف';
        fileNameSpan.classList.remove('text-red-600');
        return;
    }

    const file = input.files[0];
    const ext = file.name.split('.').pop().toLowerCase();

    if (!['stl', 'obj'].includes(ext)) {
        fileNameSpan.textContent = 'نوع ملف غير مدعوم';
        fileNameSpan.classList.add('text-red-600');
        input.value = '';
        return;
    }

    fileNameSpan.textContent = file.name;
    fileNameSpan.classList.remove('text-red-600');
}

// ---------- Submit ----------
document.getElementById('orderForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = this;
    const fileInput = document.getElementById('fileInput');

    if (!fileInput.files.length) {
        showError('برجاء اختيار ملف STL أو OBJ');
        return;
    }

    const file = fileInput.files[0];
    if (file.size > 20 * 1024 * 1024) {
        showError('حجم الملف كبير جدًا (الحد الأقصى 20MB)');
        return;
    }

    const formData = new FormData(form);

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                'Accept': 'application/json',
            },
            body: formData
        });

        if (response.status === 413) {
            showError('حجم الملف أكبر من المسموح به على السيرفر');
            return;
        }

        const data = await response.json();

        if (response.status === 422) {
            let html = '<ul class="list-disc pr-5">';
            Object.values(data.errors).forEach(e => html += `<li>${e[0]}</li>`);
            html += '</ul>';
            showError(html);
            return;
        }

        if (!response.ok) {
            showError('حدث خطأ غير متوقع');
            return;
        }

        showSuccess(data.message || 'تم إرسال الطلب بنجاح');
        form.reset();
        document.getElementById('fileName').textContent = 'لم يتم اختيار ملف';

    } catch {
        showError('فشل الاتصال بالسيرفر');
    }
});

// ---------- Modal helpers ----------
function showModal(title, content, type) {
    const overlay = document.getElementById('modalOverlay');
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalTitle').className =
        `text-lg font-bold mb-4 ${type === 'error' ? 'text-red-600' : 'text-green-600'}`;
    document.getElementById('modalContent').innerHTML = content;

    overlay.classList.remove('hidden');
    overlay.classList.add('flex');
}

function closeModal() {
    const overlay = document.getElementById('modalOverlay');
    overlay.classList.add('hidden');
    overlay.classList.remove('flex');
}

function showError(msg) {
    showModal('خطأ', msg, 'error');
}

function showSuccess(msg) {
    showModal('تم بنجاح', msg, 'success');
}
</script>
@endpush
