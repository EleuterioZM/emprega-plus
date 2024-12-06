<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Candidato;
use App\Models\Empregador;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str; // Adicionando o uso de Str para gerar o código de verificação
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail; // Criar esse Mailable

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        try {
            // Validação do formulário
            $validated = $request->validate([
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'user_type' => ['required', 'in:candidato,empregador'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'terms' => ['required', 'accepted'],
            ]);
    
            // Criação do usuário
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'user_type' => $request->user_type,
                'password' => Hash::make($request->password),
            ]);
    
            // Gerar código de verificação
            $verificationCode = Str::random(4);
            $user->verification_code = $verificationCode;
            $user->save();
    
            // Enviar o código de verificação por e-mail
            Mail::to($user->email)->send(new VerificationCodeMail($user));
    
            // Criação do perfil de Candidato ou Empregador
            if ($user->user_type == 'candidato') {
                $candidato = new Candidato();
                $candidato->user_id = $user->id;
    
                if ($request->hasFile('cv')) {
                    // Caminho do diretório onde os CVs serão armazenados
                    $cvDirectory = storage_path('app/public/cv');
                    
                    // Verificar se o diretório existe, caso contrário, criar
                    if (!is_dir($cvDirectory)) {
                        try {
                            mkdir($cvDirectory, 0755, true); // Criar o diretório com permissões adequadas
                            Log::info('Diretório criado com sucesso:', ['path' => $cvDirectory]);
                        } catch (\Exception $e) {
                            Log::error('Erro ao criar diretório:', ['error' => $e->getMessage()]);
                            throw new \Exception('Erro ao criar o diretório para armazenamento de CV.');
                        }
                    }
                    
                    // Processar o upload do arquivo
                    try {
                        $cvFile = $request->file('cv');
                        $fileName = uniqid('cv_') . '.' . $cvFile->getClientOriginalExtension(); // Nome único do arquivo
                        $cvPath = $cvFile->storeAs('public/cv', $fileName); // Usar o método Laravel para armazenar no local correto
                
                        $candidato->cv = 'cv/' . $fileName; // Salvar o caminho relativo do arquivo na BD
                        Log::info('CV armazenado com sucesso:', ['path' => $cvPath]);
                    } catch (\Exception $e) {
                        Log::error('Erro ao armazenar CV:', ['error' => $e->getMessage()]);
                        throw new \Exception('Erro ao armazenar o CV. Verifique as permissões ou o caminho.');
                    }
                }
                
                $candidato->portfolio = $request->portfolio;
                $candidato->save();
            } elseif ($user->user_type == 'empregador') {
                $empregador = new Empregador();
                $empregador->user_id = $user->id;
                $empregador->company_name = $request->company_name;
                $empregador->save();
            }
    
            Log::info('Email de verificação enviado para:', ['email' => $user->email]);
    
            // Redirecionar para a página de verificação
            return redirect()->route('verification.notice')->with('email', $request->email);
    
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Erro de banco de dados:', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Ocorreu um problema com o banco de dados. Por favor, tente novamente.']);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Erro de validação:', ['errors' => $e->errors()]);
            return back()->withErrors($e->errors());
    
        } catch (\Swift_TransportException $e) {
            Log::error('Erro ao enviar e-mail:', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Não foi possível enviar o e-mail de verificação. Por favor, verifique seu endereço de e-mail ou tente novamente mais tarde.']);
    
        } catch (\Exception $e) {
            Log::error('Erro inesperado:', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Ocorreu um erro inesperado. Por favor, tente novamente.']);
        }
    }
    

    public function showVerificationForm(Request $request)
    {
        return view('auth.verify', ['email' => $request->email]);
    }

    public function verify(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'verification_code' => 'required|string|size:4',
        ]);

        // Buscar o usuário com os dados fornecidos
        $user = User::where('email', $request->email)
            ->where('verification_code', $request->verification_code)
            ->first();

        if ($user) {
            // Confirmar o email do usuário e limpar o código de verificação
            $user->email_verified_at = now();
            $user->verification_code = null;
            $user->save();

            // Redirecionar para a página de login com sucesso
            return redirect()->route('login')->with('success', 'Usuário verificado com sucesso. Você pode fazer login agora.');
        }

        // Redirecionar de volta com erro, mantendo o valor do e-mail
        return redirect()->back()->withInput()->withErrors(['verification_code' => 'Código de verificação inválido.']);
    }
}
