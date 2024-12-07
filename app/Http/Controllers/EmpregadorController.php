<?php

namespace App\Http\Controllers;

use App\Models\Empregador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage; // Adicione esta linha para garantir que o Storage seja utilizado

class EmpregadorController extends Controller
{
    public function index() {
        $empregadores = Empregador::paginate(10);
        return view('empregadores.index', compact('empregadores'));
    }

    public function edit()
    {
        // Buscar dados do empregador logado
        $empregador = Empregador::where('user_id', Auth::id())->first();

        return view('empregadores.edit', compact('empregador'));
    }

    public function update(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'company_name' => 'nullable|string|max:500',
            'telefone' => 'nullable|string|max:15',
            'site' => 'nullable|url',
            'localizacao' => 'nullable|string|max:255',
            'endereco' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Busca o empregador logado
        $empregador = Empregador::where('user_id', Auth::id())->first();
    
        if ($empregador) {
            Log::info('Empregador encontrado para atualização:', ['empregador_id' => $empregador->id]);
    
            // Atualiza os dados do empregador
            $empregador->company_name = $request->company_name;
            $empregador->telefone = $request->telefone;
            $empregador->site = $request->site;
            $empregador->localizacao = $request->localizacao;
            $empregador->endereco = $request->endereco;
    
            // Verifica e processa a foto de perfil, se enviada
            if ($request->hasFile('profile_image')) {
                Log::info('Arquivo de foto recebido. Processando...');
    
                // Remove a foto existente se necessário
                if ($empregador->profile_image && Storage::exists('public/Empregadores_Profile/' . $empregador->profile_image)) {
                    Log::info('Removendo foto existente: ' . $empregador->profile_image);
                    Storage::delete('public/Empregadores_Profile/' . $empregador->profile_image);
                }
    
                // Gera o nome do arquivo da foto no formato desejado
                $extension = $request->file('profile_image')->getClientOriginalExtension();
                $empresaNome = str_replace(' ', '_', strtolower($empregador->company_name));
                $dataAtual = now()->format('Ymd_His');
                $fileName = "{$empresaNome}_fotodeperfil_{$dataAtual}.{$extension}";
    
                Log::info('Nome do arquivo gerado para a foto: ' . $fileName);
    
                // Armazena a foto na pasta
                $path = $request->file('profile_image')->storeAs('public/Empregadores_Profile', $fileName);
                Log::info('Foto armazenada em: ' . $path);
    
                // Atualiza o nome da foto no banco de dados
                $empregador->profile_image = $fileName;
                Log::info('Nome da foto atualizado no banco de dados: ' . $fileName);
            }
    
            // Se o empregador preencheu todos os campos obrigatórios, marca como ativo
            if ($empregador->company_name && $empregador->telefone && $empregador->site && $empregador->localizacao && $empregador->endereco) {
                $empregador->ativo = 1;  // Marca como ativo
            }
    
            // Salva as alterações
            $empregador->save();
            Log::info('Empregador atualizado com sucesso.');
    
            // Retorna à página de edição com a mensagem de sucesso
            return redirect()->route('empregadores.edit')->with('success', 'Perfil da empresa atualizado com sucesso!');
        } else {
            // Log de erro caso o empregador não seja encontrado
            Log::error('Empregador não encontrado para atualização', ['user_id' => Auth::id()]);
            return redirect()->route('empregadores.edit')->with('error', 'Empregador não encontrado.');
        }
    }
    
    public function alterarStatus($empregadorId)
    {
        // Buscar o empregador
        $empregador = Empregador::findOrFail($empregadorId);
    
        // Alternar o status
        $empregador->ativo = $empregador->ativo === 1 ? 0 : 1;
    
        // Salvar alterações
        $empregador->save();
    
        // Retornar para a lista de empregadores com uma mensagem de sucesso
        return redirect()->route('empregadores.index')->with('success', 'Status do empregador alterado com sucesso!');
    }
    
}
