<?php

namespace App\Http\Controllers;

use App\Models\Empregador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EmpregadorController extends Controller
{
    public function index() {
        $empregadores = Empregador::paginate(10);
        return view('empregadores.index', compact('empregadores'));
    }

    public function edit()
    {
        $empregador = Empregador::where('user_id', Auth::id())->first();
        return view('empregadores.edit', compact('empregador'));
    }

    public function update(Request $request)
    {
        Log::info('Dados recebidos: ', $request->all());

        $request->validate([
            'company_name' => 'nullable|string|max:500',
            'telefone' => 'nullable|string|max:15',
            'site' => 'nullable|url',
            'localizacao' => 'nullable|string|max:255',
            'endereco' => 'nullable|string|max:255',
            'empresa_descricao' => 'nullable|string|max:1000',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $empregador = Empregador::where('user_id', Auth::id())->first();
    
        if ($empregador) {
            Log::info('Empregador encontrado para atualização.', ['empregador_id' => $empregador->id]);
    
            $empregador->company_name = $request->company_name;
            $empregador->telefone = $request->telefone;
            $empregador->site = $request->site;
            $empregador->localizacao = $request->localizacao;
            $empregador->empresa_descricao = $request->empresa_descricao;
            $empregador->endereco = $request->endereco;
    
            
            // Processar a foto de perfil, se enviada
            if ($request->hasFile('profile_image')) {
                Log::info('Arquivo de foto recebido. Processando...');
    
                $directoryPath = 'Empregadores_Profile';
    
                // Remove a foto existente se necessário
                if ($empregador->profile_image && Storage::disk('public')->exists($directoryPath . '/' . $empregador->profile_image)) {
                    Log::info('Removendo foto existente: ' . $empregador->profile_image);
                    Storage::disk('public')->delete($directoryPath . '/' . $empregador->profile_image);
                }
    
                // Gera o nome do arquivo
                $extension = $request->file('profile_image')->getClientOriginalExtension();
                $empresaNome = str_replace(' ', '_', strtolower($empregador->company_name));
                $dataAtual = now()->format('Ymd_His');
                $fileName = "{$empresaNome}_fotodeperfil_{$dataAtual}.{$extension}";
    
                Log::info('Nome do arquivo gerado para a foto: ' . $fileName);
    
                // Armazena a foto no disco público
                $path = $request->file('profile_image')->storeAs($directoryPath, $fileName, 'public');
                Log::info('Foto armazenada em: ' . $path);
    
                // Atualiza o nome da foto no banco de dados
                $empregador->profile_image = $fileName;
                Log::info('Nome da foto atualizado no banco de dados: ' . $fileName);
            }
    
            // Define como ativo se todos os campos obrigatórios estiverem preenchidos
            if ($empregador->company_name && $empregador->telefone && $empregador->site && $empregador->localizacao && $empregador->endereco) {
                $empregador->ativo = 1;
            }
    
            $empregador->save();
            Log::info('Empregador atualizado com sucesso.');
    
            return redirect()->route('empregadores.index')->with('success', 'Perfil da empresa atualizado com sucesso!');
        } else {
            Log::error('Empregador não encontrado para atualização.', ['user_id' => Auth::id()]);
            return redirect()->route('empregadores.index')->with('error', 'Empregador não encontrado.');
        }
    }
    
    public function alterarStatus($empregadorId)
    {
        $empregador = Empregador::findOrFail($empregadorId);
    
        $empregador->ativo = $empregador->ativo === 1 ? 0 : 1;
    
        $empregador->save();
    
        return redirect()->route('empregadores.index')->with('success', 'Status do empregador alterado com sucesso!');
    }
    
   
}
