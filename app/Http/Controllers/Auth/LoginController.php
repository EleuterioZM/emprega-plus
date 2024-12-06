<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    // Mostrar o formulário de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Processar o login
    public function login(Request $request)
    {
        // Validação dos dados de entrada
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Determinar se a entrada é um email ou um username
        $field = filter_var($credentials['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Tentativa de login com as credenciais fornecidas
        if (Auth::attempt([$field => $credentials['username'], 'password' => $credentials['password']])) {
            // Após autenticação, verificar se o e-mail foi verificado
            $user = Auth::user();
            if (is_null($user->email_verified_at)) {
                // Deslogar o usuário se o e-mail não estiver verificado
                Auth::logout();
                // Redirecionar de volta com uma mensagem de erro
                throw ValidationException::withMessages([
                    'username' => 'O e-mail do usuário não foi verificado. Verifique seu e-mail.',
                ]);
            }

            // Se o e-mail estiver verificado, redireciona para o dashboard ou outra página desejada
            return redirect()->intended('/dashboard');
        }

        // Se a autenticação falhar, redireciona de volta para o formulário de login com uma mensagem de erro
        throw ValidationException::withMessages([
            'username' => 'As credenciais fornecidas estão incorretas.',
        ]);
    }

    // Processar logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
