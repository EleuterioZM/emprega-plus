<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CandidatoController extends Controller
{
    /**
     * Exibir a lista de candidatos.
     */
    public function index()
    {
        $candidatos = Candidato::paginate(10);
        return view('candidatos.index', compact('candidatos'));
    }

    /**
     * Exibir o formulário de edição do perfil.
     */
    public function edit()
    {
        $candidato = Candidato::where('user_id', Auth::id())->first();
        return view('candidatos.edit', compact('candidato'));
    }

    /**
     * Atualizar os dados do perfil.
     */
    public function update(Request $request)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'descricao' => 'nullable|string|max:500',
            'telefone' => 'nullable|string|max:15',
            'habilidades' => 'nullable|string|max:255',
            'cv' => 'nullable|mimes:pdf,doc,docx|max:2048',
            'portfolio' => 'nullable|url',
        ]);
    
        // Carregar o candidato com o relacionamento de usuário
        $candidato = Candidato::where('user_id', Auth::id())->first();
    
        if ($candidato) {
            Log::info('Candidato encontrado para atualização.', ['candidato_id' => $candidato->id]);
    
            $candidato->descricao = $request->descricao;
            $candidato->telefone = $request->telefone;
            $candidato->habilidades = $request->habilidades;
            $candidato->portfolio = $request->portfolio;
    
            // Processar a foto, se enviada
            if ($request->hasFile('foto')) {
                Log::info('Arquivo de foto recebido. Processando...');
    
                $fotoDirectoryPath = 'Candidatos_Fotos';
    
                // Remover a foto existente, se necessário
                if ($candidato->foto && Storage::disk('public')->exists($fotoDirectoryPath . '/' . $candidato->foto)) {
                    Log::info('Removendo foto existente: ' . $candidato->foto);
                    Storage::disk('public')->delete($fotoDirectoryPath . '/' . $candidato->foto);
                }
    
                // Gerar o nome do arquivo baseado no nome original
                $originalFileName = pathinfo($request->file('foto')->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $request->file('foto')->getClientOriginalExtension();
                $dataAtual = now()->format('Ymd_His');
                $fileName = "{$originalFileName}_fotodeperfil_{$dataAtual}.{$extension}";
    
                Log::info('Nome do arquivo gerado para a foto: ' . $fileName);
    
                // Armazenar a foto no disco público
                $path = $request->file('foto')->storeAs($fotoDirectoryPath, $fileName, 'public');
                Log::info('Foto armazenada em: ' . $path);
    
                // Atualizar o nome da foto no banco de dados
                $candidato->foto = $fileName;
            }
    
            // Processar o CV, se enviado
            if ($request->hasFile('cv')) {
                Log::info('Arquivo de CV recebido. Processando...');
    
                $cvDirectoryPath = 'Candidatos_CVs';
    
                // Remover o CV existente, se necessário
                if ($candidato->cv && Storage::disk('public')->exists($cvDirectoryPath . '/' . $candidato->cv)) {
                    Log::info('Removendo CV existente: ' . $candidato->cv);
                    Storage::disk('public')->delete($cvDirectoryPath . '/' . $candidato->cv);
                }
    
                // Gerar o nome do arquivo do CV
                $originalFileName = pathinfo($request->file('cv')->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $request->file('cv')->getClientOriginalExtension();
                $dataAtual = now()->format('Ymd_His');
                $fileName = "{$originalFileName}_cv_{$dataAtual}.{$extension}";
    
                Log::info('Nome do arquivo gerado para o CV: ' . $fileName);
    
                // Armazenar o CV no disco público
                $path = $request->file('cv')->storeAs($cvDirectoryPath, $fileName, 'public');
                Log::info('CV armazenado em: ' . $path);
    
                // Atualizar o nome do CV no banco de dados
                $candidato->cv = $fileName;
            }
    
            $candidato->save();
            Log::info('Candidato atualizado com sucesso.');
    
          //  return redirect()->route('candidatos.edit')->with('success', 'Perfil atualizado com sucesso!');
            return redirect()->route('candidatos.index')->with('success', 'Candidato atualizado com sucesso!');

        } else {
            Log::error('Candidato não encontrado para atualização.', ['user_id' => Auth::id()]);
            return redirect()->route('candidatos.edit')->with('error', 'Candidato não encontrado.');
        }
    }
    
    /**
     * Alterar o status de um candidato.
     */
    public function alterarStatus($candidatoId)
    {
        // Encontra o candidato pelo ID ou retorna 404 se não encontrado
        $candidato = Candidato::findOrFail($candidatoId);
    
        // Alterna o status do candidato entre 1 (Ativo) e 0 (Desativado)
        $candidato->ativo = $candidato->ativo === 1 ? 0 : 1;
    
        // Salva a alteração no banco de dados
        $candidato->save();
    
        // Redireciona de volta para a lista de candidatos com uma mensagem de sucesso
        return redirect()->route('candidatos.index')->with('success', 'Status do candidato alterado com sucesso!');
    }
    

public function downloadCV($filename)
{
    $filePath = storage_path('app/public/Candidatos_CVs/' . $filename);


    if (file_exists($filePath)) {
        return response()->download($filePath);
    }
    
    return redirect()->back()->with('error', 'Arquivo não encontrado!');
    
}

}
