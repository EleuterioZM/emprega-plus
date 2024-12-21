<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use App\Models\Empregador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Pega o usuário autenticado

        // Verifica o tipo de usuário e retorna os dados específicos
        if ($user->user_type == 'candidato') {
            $perfil = Candidato::where('user_id', $user->id)->first();
        } else {
            $perfil = Empregador::where('user_id', $user->id)->first();
        }

        return view('perfil.index', compact('perfil'));
    }

   
    public function delete(Request $request)
    {
        $user = auth()->user(); // Pega o usuário autenticado

        // Log: Iniciando o processo de exclusão do perfil
        Log::info('Iniciando a exclusão do perfil', ['user_id' => $user->id, 'user_type' => $user->user_type]);

        try {
            if ($user->user_type == 'candidato') {
                // Deletar os dados do candidato
                $perfil = Candidato::where('user_id', $user->id)->first();

                if ($perfil) {
                    Log::info('Excluindo perfil de Candidato', ['perfil_id' => $perfil->id]);
                    $perfil->delete();
                } else {
                    Log::warning('Perfil de Candidato não encontrado para exclusão', ['user_id' => $user->id]);
                }
            } else {
                // Deletar os dados do empregador
                $perfil = Empregador::where('user_id', $user->id)->first();

                if ($perfil) {
                    Log::info('Excluindo perfil de Empregador', ['perfil_id' => $perfil->id]);
                    $perfil->delete();
                } else {
                    Log::warning('Perfil de Empregador não encontrado para exclusão', ['user_id' => $user->id]);
                }
            }

            // Deletar o usuário
            Log::info('Deletando o usuário', ['user_id' => $user->id]);
            $user->delete();

            Log::info('Perfil excluído com sucesso!', ['user_id' => $user->id]);
        } catch (\Exception $e) {
            // Em caso de erro, logar a exceção
            Log::error('Erro ao tentar excluir perfil', [
                'user_id' => $user->id,
                'user_type' => $user->user_type,
                'error' => $e->getMessage()
            ]);

            // Redirecionar com erro
            return redirect()->route('dashboard')->with('error', 'Erro ao excluir o perfil. Por favor, tente novamente.');
        }

        return redirect()->route('dashboard')->with('success', 'Perfil excluído com sucesso!');
    }
}
