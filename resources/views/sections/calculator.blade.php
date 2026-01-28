<section id="calculator" class="py-16 bg-gray-100">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">حاسبة التكلفة</h2>
        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">نوع المادة</label>
                    <select id="material" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-500">
                        <option value="50">PLA - 50 جنيه مصري/سم³</option>
                        <option value="60">ABS - 60 جنيه مصري/سم³</option>
                        <option value="70">PETG - 70 جنيه مصري/سم³</option>
                        <option value="100">Resin - 100 جنيه مصري/سم³</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">الحجم (سم³)</label>
                    <input type="number" id="volume" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-500" placeholder="أدخل الحجم">
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">جودة الطباعة</label>
                    <select id="quality" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-500">
                        <option value="1">عادية (x1)</option>
                        <option value="1.5">جيدة (x1.5)</option>
                        <option value="2">ممتازة (x2)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">الخدمات الإضافية</label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" id="postProcessing" class="ml-2">
                            <span>معالجة بعد الطباعة (+30 جنيه مصري)</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" id="express" class="ml-2">
                            <span>خدمة express (+50%)</span>
                        </label>
                    </div>
                </div>
            </div>
            <button onclick="calculateCost()" class="w-full mt-6 bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700 transition">
                <i class="fas fa-calculator ml-2"></i>
                احسب التكلفة
            </button>
            <div id="costResult" class="mt-6 p-4 bg-purple-50 rounded-lg hidden">
                <h3 class="font-bold text-lg mb-2">التكلفة الإجمالية:</h3>
                <p class="text-3xl font-bold text-purple-600"><span id="totalCost">0</span> جنيه مصري</p>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
function calculateCost() {
    // جمع القيم
    const materialPrice = parseFloat(document.getElementById('material').value);
    const volume = parseFloat(document.getElementById('volume').value);
    const qualityMultiplier = parseFloat(document.getElementById('quality').value);

    const postProcessing = document.getElementById('postProcessing').checked;
    const express = document.getElementById('express').checked;

    // التحقق من الحجم
    if (isNaN(volume) || volume <= 0) {
        alert('برجاء إدخال حجم صالح');
        return;
    }

    // حساب التكلفة الأساسية
    let cost = volume * materialPrice * qualityMultiplier;

    // إضافة الخدمات الإضافية
    if (postProcessing) cost += 30;
    if (express) cost *= 1.5;

    // تقريب للعدد العشري
    cost = Math.round(cost * 100) / 100;

    // عرض النتيجة
    document.getElementById('totalCost').textContent = cost;
    document.getElementById('costResult').classList.remove('hidden');
}
</script>
@endpush
