<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\Candidatura;
use App\Models\JobPostLike;
use App\Models\Comentario;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    // Método para exibir o feed de vagas
    public function index()
    {
        // Carregar as postagens de vagas, com likes e comentários
        $jobPosts = JobPost::with(['empregador', 'likes', 'comentarios'])
            ->latest() // Ordena as postagens mais recentes
            ->paginate(10); // Paginação para o feed

        // Obter as candidaturas e likes do usuário atual
        $userCandidaturas = auth()->user()->candidato ? auth()->user()->candidato->candidaturas->pluck('job_post_id')->toArray() : [];
        
        $userLikes = auth()->user()->candidato ? auth()->user()->candidato->likes->pluck('job_post_id')->toArray() : [];

        // Retornar a view com os dados
        return view('feed.index', compact('jobPosts', 'userCandidaturas', 'userLikes'));
    }

    // Método para curtir uma postagem
    public function like(JobPost $jobPost)
    {
        // Verificar se o usuário já curtiu a postagem
        if (!in_array($jobPost->id, auth()->user()->candidato->likes->pluck('job_post_id')->toArray())) {
            // Adiciona o like ao jobPost
            JobPostLike::create([
                'candidato_id' => auth()->user()->candidato->id,
                'job_post_id' => $jobPost->id,
            ]);
        } else {
            // Caso já tenha dado like, pode remover o like
            JobPostLike::where('candidato_id', auth()->user()->candidato->id)
                ->where('job_post_id', $jobPost->id)
                ->delete();
        }

        return back();
    }

    // Método para comentar em uma postagem
    public function comentar(Request $request, JobPost $jobPost)
    {
        $request->validate([
            'comentario' => 'required|string|max:500', // Validação para o comentário
        ]);

        // Cria o comentário na postagem
        Comentario::create([
            'candidato_id' => auth()->user()->candidato->id,
            'job_post_id' => $jobPost->id,
            'comentario' => $request->comentario,
        ]);

        return back();
    }

    // Método para se candidatar a uma vaga
    public function candidatar(JobPost $jobPost)
    {
        // Verifica se o usuário já se candidatou
        if (!in_array($jobPost->id, auth()->user()->candidato->candidaturas->pluck('job_post_id')->toArray())) {
            // Cria a candidatura para a vaga
            Candidatura::create([
                'candidato_id' => auth()->user()->candidato->id,
                'job_post_id' => $jobPost->id,
            ]);
        }

        return back();
    }
}
