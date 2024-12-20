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
        // Carregar as postagens de emprego com suas relações necessárias (empregador, likes e comentários com candidatos e usuários)
        $jobPosts = JobPost::with(['empregador.user', 'likes', 'comentarios.candidato.user'])
            ->latest()
            ->paginate(10);
    
        // Verificar as candidaturas e likes do usuário
        $userCandidato = auth()->user()->candidato; 
    
        // Lista de candidaturas do usuário
        $userCandidaturas = $userCandidato ? $userCandidato->candidaturas->pluck('job_post_id')->toArray() : [];
    
        // Lista de likes do usuário
        $userLikes = $userCandidato ? $userCandidato->likes->pluck('job_post_id')->toArray() : [];
        
        // Caminho completo da foto do candidato
        $userFoto = $userCandidato && $userCandidato->foto 
            ? asset('storage/Candidatos_Fotos/' . $userCandidato->foto)
            : asset('img/user-placeholder.png');
        
        // Verificar foto do empregador para cada postagem
        $jobPosts->each(function ($jobPost) {
            $jobPost->empregadorFoto = $jobPost->empregador && $jobPost->empregador->foto
                ? asset('storage/Empregadores_Fotos/' . $jobPost->empregador->foto)
                : asset('img/empregador-placeholder.png');
        });
    
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
     // Método para editar um comentário
     public function updateComment(Request $request, Comentario $comentario)
     {
         // Validação do comentário
         $request->validate([
             'comentario' => 'required|string|max:500',
         ]);
 
         // Verifica se o comentário pertence ao usuário autenticado
         if ($comentario->candidato_id != auth()->user()->candidato->id) {
             return redirect()->back()->withErrors('Você não tem permissão para editar este comentário.');
         }
 
         // Atualiza o comentário
         $comentario->update([
             'comentario' => $request->comentario,
         ]);
 
         return back();
     }
 
     // Método para excluir um comentário
     public function deleteComment(Comentario $comentario)
     {
         // Verifica se o comentário pertence ao usuário autenticado
         if ($comentario->candidato_id != auth()->user()->candidato->id) {
             return redirect()->back()->withErrors('Você não tem permissão para excluir este comentário.');
         }
 
         // Exclui o comentário
         $comentario->delete();
 
         return back();
     }
}
