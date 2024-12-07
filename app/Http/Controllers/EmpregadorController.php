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
        'company_name' => 'nullable|string|max:500',  // Validação para 'company_name'
        'telefone' => 'nullable|string|max:15',
        'site' => 'nullable|url',
        'localizacao' => 'nullable|string|max:255',
        'endereco' => 'nullable|string|max:255',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $empregador = Empregador::where('user_id', Auth::id())->first();

    if ($empregador) {
        Log::info('Empregador encontrado para atualização:', ['empregador_id' => $empregador->id]);

        // Atualiza os dados do empregador
        $empregador->company_name = $request->company_name;  // Usando 'company_name'
        $empregador->telefone = $request->telefone;
        $empregador->site = $request->site;
        $empregador->localizacao = $request->localizacao;
        $empregador->endereco = $request->endereco;

        // Verificar se a foto foi enviada
        if ($request->hasFile('profile_image')) {
            Log::info('Arquivo de foto recebido. Processando...');

            // Verificar e remover a foto existente
            if ($empregador->profile_image && Storage::exists('public/Empregadores_Profile/' . $empregador->profile_image)) {
                Log::info('Removendo foto existente: ' . $empregador->profile_image);
                Storage::delete('public/Empregadores_Profile/' . $empregador->profile_image);
            }

            // Gera o nome do arquivo da foto no formato desejado
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            $empresaNome = str_replace(' ', '_', strtolower($empregador->company_name));  // Usando 'company_name' agora
            $dataAtual = now()->format('Ymd_His'); // Data atual no formato Ymd_His (ano, mês, dia, hora, minuto, segundo)
            $fileName = "{$empresaNome}_fotodeperfil_{$dataAtual}.{$extension}";

            Log::info('Nome do arquivo gerado para a foto: ' . $fileName);

            // Armazena a foto na pasta 'Empregadores_Profile'
            $path = $request->file('profile_image')->storeAs('public/Empregadores_Profile', $fileName);
            Log::info('Foto armazenada em: ' . $path);

            // Atualiza o nome da foto no banco de dados
            $empregador->profile_image = $fileName;
            Log::info('Nome da foto atualizado no banco de dados: ' . $fileName);
        }

        // Verifica se o empregador preencheu todos os campos obrigatórios e marca como ativo
        if ($empregador->company_name && $empregador->telefone && $empregador->site && $empregador->localizacao && $empregador->endereco) {
            $empregador->ativo = true;
        }

        $empregador->save();
        Log::info('Empregador atualizado com sucesso.');

        // Retorna para a página de edição com sucesso
        return redirect()->route('empregadores.edit')->with('success', 'Perfil da empresa atualizado com sucesso!');
    } else {
        // Log caso o empregador não seja encontrado
        Log::error('Empregador não encontrado para atualização', ['user_id' => Auth::id()]);
        return redirect()->route('empregadores.edit')->with('error', 'Empregador não encontrado.');
    }
}


}
