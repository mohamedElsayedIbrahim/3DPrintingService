<section id="order" class="py-16">
    <div class="container mx-auto px-4 max-w-4xl">
        <h2 class="text-3xl font-bold text-center mb-12">طلب جديد</h2>

        {{-- success message --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- validation errors --}}
        @if($errors->any())
            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pr-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
    id="orderForm"
    action="{{ route('orders.store') }}"
    method="POST"
    enctype="multipart/form-data"
    class="bg-white p-8 rounded-xl shadow space-y-6"
>
    @csrf

    <div id="formMessages"></div>

    <input name="full_name" placeholder="الاسم الكامل" class="w-full border p-3 rounded">
    <input name="email" type="email" placeholder="البريد الإلكتروني" class="w-full border p-3 rounded">
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

    <input
        id="fileInput"
        name="file"
        type="file"
        required
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


@push('scripts')
    <script>
        
        function showFileName(input) {
    const fileName = input.files.length
        ? input.files[0].name
        : 'لم يتم اختيار ملف';

    document.getElementById('fileName').textContent = fileName;
}

document.getElementById('orderForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = this;
    const url = form.action;
    const formData = new FormData(form);
    const messages = document.getElementById('formMessages');

    messages.innerHTML = '';

    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                'Accept': 'application/json',
            },
            body: formData
        });

        const data = await response.json();

        if (!response.ok) {
            throw data;
        }

        messages.innerHTML = `
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                ${data.message}
            </div>
        `;

        form.reset();

    } catch (error) {
        if (error.errors) {
            let errorsHtml = '<ul class="list-disc pr-5">';
            Object.values(error.errors).forEach(err => {
                errorsHtml += `<li>${err[0]}</li>`;
            });
            errorsHtml += '</ul>';

            messages.innerHTML = `
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    ${errorsHtml}
                </div>
            `;
        } else {
            messages.innerHTML = `
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    حدث خطأ غير متوقع
                </div>
            `;
        }
    }
});
</script>

@endpush
