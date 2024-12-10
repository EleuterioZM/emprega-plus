<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Candidato;
use App\Models\Empregador;
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

        // Tentativa de autenticação
        if (Auth::attempt([$field => $credentials['username'], 'password' => $credentials['password']])) {
            $user = Auth::user();

            // Verificar status de 'ativo' para Empregador
            $empregador = Empregador::where('user_id', $user->id)->first();
            if ($empregador && $empregador->ativo === 0) {
                Auth::logout();  // Faz logout imediatamente
                return redirect()->route('login')->withErrors([
                    'username' => 'Sua conta de Empregador está desativada. Entre em contato com o suporte.',
                ]);
            }

            // Verificar status de 'ativo' para Candidato
            $candidato = Candidato::where('user_id', $user->id)->first();
            if ($candidato && $candidato->ativo === 0) {
                Auth::logout();  // Faz logout imediatamente
                return redirect()->route('login')->withErrors([
                    'username' => 'Sua conta de Candidato está desativada. Entre em contato com o suporte.',
                ]);
            }

            // Verificar se o e-mail foi confirmado
            if (is_null($user->email_verified_at)) {
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'username' => 'O e-mail do usuário não foi verificado. Verifique seu e-mail.',
                ]);
            }

            // Redirecionar para o dashboard
            return redirect()->intended('/dashboard');
        }

        // Caso as credenciais estejam incorretas
        return redirect()->route('login')->withErrors([
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
