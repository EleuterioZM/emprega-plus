<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class PasswordResetController extends Controller
{
    // Mostrar o formulário para solicitar o código de verificação
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // Enviar o código de verificação por e-mail
    public function sendVerificationCode(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $user = User::where('email', $request->email)->first();
        $verificationCode = rand(100000, 999999); // Gera um código de verificação de 6 dígitos

        // Salva o código de verificação no banco de dados
        $user->verification_code = $verificationCode;
        $user->save();

        // Envia o código de verificação por e-mail
        Mail::send('emails.password-reset', ['code' => $verificationCode], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Código de Verificação');
        });

        return redirect()->route('password.reset')->with('status', 'Código de verificação enviado para seu e-mail.');
    }

    // Mostrar o formulário para redefinir a senha
    public function showResetPasswordForm()
    {
        return view('auth.reset-password');
    }

    // Redefinir a senha
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'verification_code' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::where('email', $request->email)->where('verification_code', $request->verification_code)->first();

        if (!$user) {
            return back()->withErrors(['verification_code' => 'Código de verificação inválido.']);
        }

        // Redefine a senha do usuário
        $user->password = Hash::make($request->password);
        $user->verification_code = null; // Limpa o código de verificação após o uso
        $user->save();

        return redirect()->route('login')->with('status', 'Senha redefinida com sucesso.');
    }
}
