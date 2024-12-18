<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\Empregador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class JobPostController extends Controller
{
    public function index()
    {
        $jobPosts = JobPost::paginate(10);
        return view('job_posts.index', compact('jobPosts'));
    }

    public function create()
    {
        return view('job_posts.create');
    }

    public function store(Request $request)
    {
        // Logando os dados recebidos
        Log::info('Dados recebidos no create de JobPost', $request->all());

        // Validação dos dados
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string|max:2000',
            'localizacao' => 'required|string|max:255',
            'tipo' => 'required|in:tempo integral,meio período,freelance',
            'salario' => 'nullable|numeric|min:0',
            'documento_pdf' => 'nullable|file|mimes:pdf|max:2048',
            'validade' => 'required|date|after:today',
        ]);

        // Verificando se o usuário está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para criar uma vaga.');
        }

        $empregador = Auth::user()->empregador;
        if (!$empregador) {
            Log::error('Usuário não tem empregador associado', ['user_id' => Auth::id()]);
            return redirect()->route('job_posts.create')->with('error', 'Você precisa ser um empregador para criar uma vaga.');
        }

        // Criando o JobPost
        $jobPost = new JobPost();
        $jobPost->empregador_id = $empregador->id;
        $jobPost->titulo = $request->titulo;
        $jobPost->descricao = $request->descricao;
        $jobPost->localizacao = $request->localizacao;
        $jobPost->tipo = $request->tipo;
        $jobPost->salario = $request->salario;
        $jobPost->validade = $request->validade;
        $jobPost->ativo = true; // Definindo ativo como true por padrão

        // Verificar se o arquivo foi enviado
        if ($request->hasFile('documento_pdf')) {
            $file = $request->file('documento_pdf');

            // Logando as informações do arquivo recebido
            Log::info('Arquivo PDF recebido', [
                'file_name' => $file->getClientOriginalName(),
                'file_size' => $file->getSize(),
                'file_mime' => $file->getMimeType(),
            ]);

            // Definindo o diretório e nome do arquivo
            $directoryPath = 'JobPosts_Documents';
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs($directoryPath, $fileName, 'public');

            // Verificando se o arquivo foi armazenado corretamente
            if ($path) {
                Log::info('Documento PDF armazenado com sucesso', ['path' => $path]);
                $jobPost->documento_pdf = $fileName;
            } else {
                Log::error('Erro ao armazenar o arquivo PDF');
            }
        }

        // Salvando o JobPost no banco de dados
        $jobPost->save();

        // Logando o sucesso ao salvar
        Log::info('Vaga criada com sucesso!', ['jobPost' => $jobPost]);

        // Redirecionando para a lista de vagas com sucesso
        return redirect()->route('job_posts.index')->with('success', 'Vaga criada com sucesso!');
    }

    public function edit($id)
    {
        $jobPost = JobPost::findOrFail($id);
        return view('job_posts.edit', compact('jobPost'));
    }

    public function update(Request $request, $id)
    {
        // Validação dos dados
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string|max:2000',
            'localizacao' => 'required|string|max:255',
            'tipo' => 'required|in:tempo integral,meio período,freelance',
            'salario' => 'nullable|numeric|min:0',
            'documento_pdf' => 'nullable|file|mimes:pdf|max:2048',
            'validade' => 'required|date|after:today',
        ]);

        $jobPost = JobPost::findOrFail($id);

        $jobPost->titulo = $request->titulo;
        $jobPost->descricao = $request->descricao;
        $jobPost->localizacao = $request->localizacao;
        $jobPost->tipo = $request->tipo;
        $jobPost->salario = $request->salario;
        $jobPost->validade = $request->validade;
        $jobPost->ativo = true; // Garantir que será sempre ativo por padrão

        // Atualiza o upload do documento PDF, se enviado
        if ($request->hasFile('documento_pdf')) {
            $directoryPath = 'JobPosts_Documents';

            // Remove o documento existente, se necessário
            if ($jobPost->documento_pdf && Storage::disk('public')->exists($directoryPath . '/' . $jobPost->documento_pdf)) {
                Storage::disk('public')->delete($directoryPath . '/' . $jobPost->documento_pdf);
            }

            $fileName = time() . '_' . $request->file('documento_pdf')->getClientOriginalName();
            $path = $request->file('documento_pdf')->storeAs($directoryPath, $fileName, 'public');
            $jobPost->documento_pdf = $fileName;

            // Logando o caminho do novo documento PDF
            Log::info('Documento PDF atualizado', ['path' => $path]);
        }

        // Salvando as alterações no JobPost
        $jobPost->save();

        // Logando após a atualização
        Log::info('Vaga atualizada com sucesso!', ['jobPost' => $jobPost]);

        // Redirecionando para a lista de vagas com sucesso
        return redirect()->route('job_posts.index')->with('info', 'Vaga atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $jobPost = JobPost::findOrFail($id);

        // Remove o documento PDF, se existir
        if ($jobPost->documento_pdf && Storage::disk('public')->exists('JobPosts_Documents/' . $jobPost->documento_pdf)) {
            Storage::disk('public')->delete('JobPosts_Documents/' . $jobPost->documento_pdf);
        }

        $jobPost->delete();

        // Logando a remoção da vaga
        Log::info('Vaga removida com sucesso!', ['jobPost_id' => $jobPost->id]);

        // Redirecionando com sucesso
        return redirect()->route('job_posts.index')->with('success', 'Vaga removida com sucesso!');
    }

    public function alterarStatus($id)
    {
        $jobPost = JobPost::findOrFail($id);
        $jobPost->ativo = !$jobPost->ativo;
        $jobPost->save();

        // Logando a alteração de status
        Log::info('Status da vaga alterado', ['jobPost_id' => $jobPost->id, 'novo_status' => $jobPost->ativo]);

        // Redirecionando com sucesso
        return redirect()->route('job_posts.index')->with('warning', 'Status da vaga alterado com sucesso!');
    }

    public function show($id)
    {
        // Buscar a vaga pelo ID
        $jobPost = JobPost::findOrFail($id);

        // Retornar a view com os dados da vaga
        return view('job_posts.show', compact('jobPost'));
    }
}
