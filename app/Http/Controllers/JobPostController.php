<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\Candidatura;
use App\Models\JobPostLike;
use App\Models\Comentario;
use Illuminate\Http\Request;

class JobPostController extends Controller
{
   
    public function index()
    {
        $jobPosts = JobPost::with(['empregador.user', 'likes', 'comentarios'])  // Carregando o relacionamento correto
            ->latest()
            ->paginate(10);  // Paginação, ajuste conforme necessário
        
        return view('job_posts.index', compact('jobPosts'));
    }
    
    // Método para exibir o formulário de criação de uma vaga
    public function create()
    {
        return view('job_posts.create');
    }

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

        $jobPost = JobPost::create([
            'empregador_id' => auth()->user()->empregador->id,
            'titulo' => $validated['titulo'],
            'descricao' => $validated['descricao'],
            'localizacao' => $validated['localizacao'],
            'tipo' => $validated['tipo'],
            'salario' => $validated['salario'],
            'validade' => $validated['validade'],
            'ativo' => true,
        ]);

        return redirect()->route('job_posts.index');
    }

    public function candidatar(Request $request, JobPost $jobPost)
    {
        Candidatura::create([
            'candidato_id' => auth()->user()->candidato->id,
            'job_post_id' => $jobPost->id,
        ]);

        return redirect()->route('job_posts.index');
    }

    public function like(JobPost $jobPost)
    {
        JobPostLike::create([
            'candidato_id' => auth()->user()->candidato->id,
            'job_post_id' => $jobPost->id,
        ]);

        return back();
    }

    public function comentar(Request $request, JobPost $jobPost)
    {
        $request->validate([
            'comentario' => 'required',
        ]);

        Comentario::create([
            'candidato_id' => auth()->user()->candidato->id,
            'job_post_id' => $jobPost->id,
            'comentario' => $request->comentario,
        ]);

        return back();
    }
}
