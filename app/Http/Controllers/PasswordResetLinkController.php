<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class PasswordResetLinkController extends Controller
{
    public function store(Request $request)
    {
        //  Validation
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        //  Send reset link
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Failed
        if ($status !== Password::RESET_LINK_SENT) {
            return response()->json([
                'message' => 'هذا البريد الإلكتروني غير مسجل لدينا',
            ], 422);
        }

        //  Success
        return response()->json([
            'message' => 'تم إرسال رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني',
        ], 200);
    }
}
