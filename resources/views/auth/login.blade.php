@extends('layouts.app')

@section('title', 'تسجيل الدخول')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">

        <h2 class="text-2xl font-bold mb-6 text-center">
            تسجيل الدخول
        </h2>

        {{-- Laravel Errors --}}
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- JS Errors --}}
        <div id="jsErrors" class="hidden mb-4 p-3 bg-red-100 text-red-700 rounded"></div>

        <form id="loginForm" method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            {{-- Email --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-1">البريد الإلكتروني</label>
                <input
                    type="email"
                    name="email"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-500"
                    placeholder="example@email.com"
                    required
                >
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-1">كلمة المرور</label>
                <input
                    type="password"
                    name="password"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-500"
                    placeholder="********"
                    required
                >
            </div>

            {{-- Remember + Forgot --}}
            <div class="mb-4 flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="ml-2">
                    تذكرني
                </label>

                <button
                    type="button"
                    onclick="openForgotModal()"
                    class="text-purple-600 hover:underline text-sm"
                >
                    نسيت كلمة المرور؟
                </button>
            </div>

            <button
                type="submit"
                class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition"
            >
                تسجيل الدخول
            </button>
        </form>

        <p class="mt-6 text-center text-gray-600 text-sm">
            ليس لديك حساب؟
            <a href="{{ route('register') }}" class="text-purple-600 hover:underline">
                سجل الآن
            </a>
        </p>

    </div>
</div>

{{-- ================= FORGOT PASSWORD MODAL ================= --}}
<div id="forgotModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-lg max-w-md w-full p-6 relative animate-scale">

        <button
            onclick="closeForgotModal()"
            class="absolute top-3 left-3 text-gray-400 hover:text-gray-600 text-xl"
        >
            &times;
        </button>

        <h3 class="text-lg font-bold mb-4 text-center">
            استعادة كلمة المرور
        </h3>

        <div id="forgotError" class="hidden mb-3 p-3 bg-red-100 text-red-700 rounded"></div>
        <div id="forgotSuccess" class="hidden mb-3 p-3 bg-green-100 text-green-700 rounded"></div>

        <form id="forgotForm" method="POST" action="{{ route('password.email') }}">
            @csrf

            <label class="block text-gray-700 font-bold mb-1">
                البريد الإلكتروني
            </label>
            <input
                type="email"
                name="email"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-500 mb-4"
                placeholder="example@email.com"
                required
            >

            <button
                type="submit"
                class="w-full bg-purple-600 text-white py-2 rounded hover:bg-purple-700"
            >
                إرسال رابط إعادة التعيين
            </button>
        </form>
    </div>
</div>

{{-- ================= STYLES ================= --}}
<style>
@keyframes scale {
    from { transform: scale(.9); opacity: 0 }
    to { transform: scale(1); opacity: 1 }
}
.animate-scale {
    animation: scale .2s ease-out;
}
</style>

<script>
/* ================= LOGIN VALIDATION ================= */
document.getElementById('loginForm').addEventListener('submit', function (e) {
    const errors = [];
    const box = document.getElementById('jsErrors');

    const email = this.email.value.trim();
    const password = this.password.value;

    box.innerHTML = '';
    box.classList.add('hidden');

    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        errors.push('برجاء إدخال بريد إلكتروني صحيح');
    }

    if (password.length < 6) {
        errors.push('كلمة المرور لا يجب أن تقل عن 6 أحرف');
    }

    if (errors.length) {
        e.preventDefault();
        box.innerHTML = `<ul class="list-disc pl-5">${errors.map(e => `<li>${e}</li>`).join('')}</ul>`;
        box.classList.remove('hidden');
    }
});

/* ================= FORGOT PASSWORD MODAL ================= */
function openForgotModal() {
    document.getElementById('forgotModal').classList.remove('hidden');
    document.getElementById('forgotModal').classList.add('flex');
}

function closeForgotModal() {
    document.getElementById('forgotModal').classList.add('hidden');
    document.getElementById('forgotModal').classList.remove('flex');
}

/* ================= FORGOT PASSWORD AJAX ================= */
document.getElementById('forgotForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = this;
    const errorBox = document.getElementById('forgotError');
    const successBox = document.getElementById('forgotSuccess');

    errorBox.classList.add('hidden');
    successBox.classList.add('hidden');

    const email = form.email.value.trim();

    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        errorBox.textContent = 'برجاء إدخال بريد إلكتروني صحيح';
        errorBox.classList.remove('hidden');
        return;
    }

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ email })
        });

        const data = await response.json();

        // ❌ Validation / Error
        if (!response.ok) {
            errorBox.textContent =
                data.message || 'حدث خطأ أثناء إرسال الرابط';
            errorBox.classList.remove('hidden');
            return;
        }

        // ✅ Success
        successBox.textContent =
            'تم إرسال رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني';
        successBox.classList.remove('hidden');

        form.reset();

        // ⏳ اغلاق المودال بعد ثانيتين
        setTimeout(() => {
            closeForgotModal();
            successBox.classList.add('hidden');
        }, 2000);

    } catch (err) {
        errorBox.textContent = 'فشل الاتصال بالسيرفر';
        errorBox.classList.remove('hidden');
    }
});
</script>

@endsection
