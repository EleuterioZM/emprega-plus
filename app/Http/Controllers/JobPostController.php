<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\Candidatura;
use App\Models\JobPostLike;
use App\Models\Comentario;
use Illuminate\Http\Request;

class JobPostController extends Controller
{
    // Método para exibir a lista de vagas
    public function index()
    {
        $jobPosts = JobPost::with(['empregador.user', 'likes', 'comentarios'])  // Carregando os relacionamentos
            ->latest()
            ->paginate(10);  // Paginação, ajuste conforme necessário

        return view('job_posts.index', compact('jobPosts'));
    }

    // Método para exibir o formulário de criação de uma vaga
    public function create()
    {
        return view('job_posts.create');
    }

    // Método para armazenar uma nova vaga
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required',
            'descricao' => 'required',
            'localizacao' => 'required',
            'tipo' => 'required',
            'salario' => 'required',
            'validade' => 'required|date',
        ]);

        // Criando a vaga com as informações validadas
        JobPost::create([
            'empregador_id' => auth()->user()->empregador->id,
            'titulo' => $validated['titulo'],
            'descricao' => $validated['descricao'],
            'localizacao' => $validated['localizacao'],
            'tipo' => $validated['tipo'],
            'salario' => $validated['salario'],
            'validade' => $validated['validade'],
            'ativo' => true,  // Vaga criada como ativa por padrão
        ]);

        return redirect()->route('job_posts.index');
    }

    // Método para o candidato se candidatar a uma vaga
    public function candidatar(Request $request, JobPost $jobPost)
    {
        Candidatura::create([
            'candidato_id' => auth()->user()->candidato->id,
            'job_post_id' => $jobPost->id,
        ]);

        return redirect()->route('job_posts.index');
    }

    // Método para o candidato dar like em uma vaga
    public function like(JobPost $jobPost)
    {
        JobPostLike::create([
            'candidato_id' => auth()->user()->candidato->id,
            'job_post_id' => $jobPost->id,
        ]);

        return back();
    }

    // Método para o candidato comentar em uma vaga
    public function comentar(Request $request, JobPost $jobPost)
    {
        $request->validate([
            'comentario' => 'required',  // Validação do comentário
        ]);

        Comentario::create([
            'candidato_id' => auth()->user()->candidato->id,
            'job_post_id' => $jobPost->id,
            'comentario' => $request->comentario,
        ]);

        return back();
    }

    // Método para exibir os detalhes de uma vaga
    public function show(JobPost $jobPost)
    {
        // Carregando a vaga com seus relacionamentos (comentários e likes)
        $jobPost->load(['empregador.user', 'likes', 'comentarios']);

        return view('job_posts.show', compact('jobPost'));
    }

    // Método para exibir o formulário de edição de uma vaga
    public function edit(JobPost $jobPost)
    {
        // Garantindo que a vaga pertence ao empregador autenticado
        if ($jobPost->empregador_id !== auth()->user()->empregador->id) {
            return redirect()->route('job_posts.index')->with('error', 'Você não tem permissão para editar esta vaga.');
        }

        return view('job_posts.edit', compact('jobPost'));
    }

    // Método para atualizar uma vaga
    public function update(Request $request, JobPost $jobPost)
    {
        // Garantindo que a vaga pertence ao empregador autenticado
        if ($jobPost->empregador_id !== auth()->user()->empregador->id) {
            return redirect()->route('job_posts.index')->with('error', 'Você não tem permissão para atualizar esta vaga.');
        }

        // Validando os dados recebidos no formulário
        $validated = $request->validate([
            'titulo' => 'required',
            'descricao' => 'required',
            'localizacao' => 'required',
            'tipo' => 'required',
            'salario' => 'required',
            'validade' => 'required|date',
        ]);

        // Atualizando os dados da vaga
        $jobPost->update([
            'titulo' => $validated['titulo'],
            'descricao' => $validated['descricao'],
            'localizacao' => $validated['localizacao'],
            'tipo' => $validated['tipo'],
            'salario' => $validated['salario'],
            'validade' => $validated['validade'],
        ]);

        return redirect()->route('job_posts.index')->with('info', 'Vaga atualizada com sucesso!');
    }
    public function alterarStatus(JobPost $jobPost)
    {
        // Alterar o status da vaga (invertendo o valor de 'ativo')
        $jobPost->ativo = !$jobPost->ativo;
        $jobPost->save();

        // Redirecionar de volta para a lista de vagas com uma mensagem de sucesso
        return redirect()->route('job_posts.index')->with('warning', 'Status da vaga alterado com sucesso!');
    }

}
