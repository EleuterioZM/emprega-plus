<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\Candidatura;
use App\Models\JobPostLike;
use App\Models\Comentario;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index()
    {
        
            $jobPosts = JobPost::with(['empregador.user', 'likes', 'comentarios'])
    ->latest()
    ->paginate(10);

    
        $userCandidato = auth()->user()->candidato; 
    
        $userCandidaturas = $userCandidato ? $userCandidato->candidaturas->pluck('job_post_id')->toArray() : [];
        $userLikes = $userCandidato ? $userCandidato->likes->pluck('job_post_id')->toArray() : [];
        
        // Caminho completo da foto do candidato
        $userFoto = $userCandidato && $userCandidato->foto 
            ? asset('storage/Candidatos_Fotos/' . $userCandidato->foto)
            : asset('img/user-placeholder.png');
    
        return view('feed.index', compact('jobPosts', 'userCandidaturas', 'userLikes', 'userFoto'));
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
