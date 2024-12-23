<?php

namespace App\Http\Controllers;

use App\Mail\CandidaturaEnviada;
use App\Models\JobPost;
use App\Models\Candidatura;
use App\Models\JobPostLike;
use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Support\Facades\Mail;

class FeedController extends Controller
{
    
    
    public function index()
    {
        // Verificar se o usuário é um empregador ou candidato
        $user = auth()->user();
        
        // Carregar as postagens de emprego com suas relações necessárias (empregador, likes e comentários com candidatos e usuários)
        $jobPosts = JobPost::with(['empregador.user', 'likes', 'comentarios.candidato.user'])
            ->where('ativo', true)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        // Para o candidato, pegar as candidaturas e likes feitos pelo usuário
        $userCandidato = $user->candidato;
        $userEmpregador = $user->empregador;
    
        // Lista de candidaturas do usuário (candidato)
        $userCandidaturas = $userCandidato ? $userCandidato->candidaturas->pluck('job_post_id')->toArray() : [];
        
        // Lista de likes do usuário (candidato)
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
    
        // Se o usuário for empregador, mostrar suas próprias vagas também
        if ($userEmpregador) {
            // Adiciona as vagas criadas pelo próprio empregador
            $empregadorJobPosts = $userEmpregador->jobPosts()->where('ativo', true)->orderBy('created_at', 'desc')->get();
            
            // Combina as postagens do empregador com as postagens paginadas
            $combinedJobPosts = $jobPosts->merge($empregadorJobPosts);
            
            // Criar um novo Paginator com a coleção combinada
            $jobPosts = new LengthAwarePaginator(
                $combinedJobPosts->forPage($jobPosts->currentPage(), $jobPosts->perPage()), 
                $combinedJobPosts->count(),
                $jobPosts->perPage(),
                $jobPosts->currentPage(),
                ['path' => LengthAwarePaginator::resolveCurrentPath()]
            );
        }
    
        // Retornar a view com as vagas e informações necessárias
        return view('feed.index', compact('jobPosts', 'userCandidaturas', 'userLikes', 'userFoto', 'userEmpregador'));
    }
    

    // Método para curtir uma postagem
    public function like(JobPost $jobPost)
    {
        $user = auth()->user();
    
        // Verificar se o usuário é um Empregador
        if ($user->empregador) {
            // Verificar se o empregador já deu like nesta vaga
            $exists = JobPostLike::where('empregador_id', $user->empregador->id)
                                  ->where('job_post_id', $jobPost->id)
                                  ->exists();
    
            if (!$exists) {
                // Criar o like para o empregador
                JobPostLike::create([
                    'empregador_id' => $user->empregador->id,
                    'job_post_id' => $jobPost->id,
                    'candidato_id' => null,  // Deixar candidato_id como null
                ]);
            } else {
                // Remover o like do empregador
                JobPostLike::where('empregador_id', $user->empregador->id)
                           ->where('job_post_id', $jobPost->id)
                           ->delete();
            }
        }
    
        // Verificar se o usuário é um Candidato
        if ($user->candidato) {
            // Verificar se o candidato já deu like nesta vaga
            $exists = JobPostLike::where('candidato_id', $user->candidato->id)
                                  ->where('job_post_id', $jobPost->id)
                                  ->exists();
    
            if (!$exists) {
                // Criar o like para o candidato
                JobPostLike::create([
                    'candidato_id' => $user->candidato->id,
                    'job_post_id' => $jobPost->id,
                    'empregador_id' => null,  // Deixar empregar_id como null
                ]);
            } else {
                // Remover o like do candidato
                JobPostLike::where('candidato_id', $user->candidato->id)
                           ->where('job_post_id', $jobPost->id)
                           ->delete();
            }
        }
    
        return back();
    }
    
    
    

    // Método para comentar em uma postagem
    public function comentar(Request $request, JobPost $jobPost)
    {
        $user = auth()->user();
    
        // Criar um novo comentário
        $comentario = new Comentario();
        $comentario->job_post_id = $jobPost->id;
        $comentario->comentario = $request->comentario;
        $comentario->created_at = now();
        $comentario->updated_at = now();
    
        // Verificar se o comentário vem de um Candidato ou Empregador
        if ($user->candidato) {
            // Se for um Candidato, o candidato_id é preenchido
            $comentario->candidato_id = $user->candidato->id;
            $comentario->empregador_id = null; // Empregador id não será preenchido
        } elseif ($user->empregador) {
            // Se for um Empregador, o empregador_id é preenchido
            $comentario->empregador_id = $user->empregador->id;
            $comentario->candidato_id = null; // Candidato id não será preenchido
        }
    
        // Salvar o comentário
        $comentario->save();
    
        return back();
    }
    

   
    public function candidatar(Request $request, $jobPostId)
    {
        $request->validate([
            'carta_candidatura' => 'nullable|file|mimes:pdf,doc,docx|max:2048',  // Adicionando validação para a carta de candidatura
            'anexo' => 'nullable|file|mimes:pdf,doc,docx|max:2048',  // Validação do arquivo de anexo
        ]);
    
        $jobPost = JobPost::findOrFail($jobPostId);
        $candidato = auth()->user()->candidato;
    
        // Criar a candidatura no banco de dados
        $candidatura = Candidatura::create([
            'candidato_id' => $candidato->id,
            'job_post_id' => $jobPost->id,
        ]);
    
        // Verificar se há carta de candidatura e fazer upload
        if ($request->hasFile('carta_candidatura')) {
            $candidatura->carta_candidatura = $request->file('carta_candidatura')->store('candidaturas', 'public');
        }
    
        // Verificar se há anexo e fazer upload
        if ($request->hasFile('anexo')) {
            $candidatura->anexo = $request->file('anexo')->store('anexos', 'public');
        }
    
        // Salvar a candidatura com os arquivos enviados
        $candidatura->save();
    
        // Enviar e-mail para o empregador com a candidatura
        Mail::to($jobPost->empregador->user->email)->send(new CandidaturaEnviada($candidatura, $jobPost));
    
        return back()->with('success', 'Candidatura enviada com sucesso!');
    }
    
     // Método para editar um comentário
     public function updateComment(Request $request, Comentario $comentario)
     {
         // Validação do comentário
         $request->validate([
             'comentario' => 'required|string|max:500',
         ]);
     
         // Verifica se o comentário pertence ao usuário autenticado (candidato ou empregador)
         if (
             (auth()->user()->candidato && $comentario->candidato_id != auth()->user()->candidato->id) &&
             (auth()->user()->empregador && $comentario->empregador_id != auth()->user()->empregador->id)
         ) {
             return redirect()->back()->withErrors('Você não tem permissão para editar este comentário.');
         }
     
         // Atualiza o comentário
         $comentario->update([
             'comentario' => $request->comentario,
         ]);
     
         return back()->with('update_success', 'Comentário atualizado com sucesso.');
     }
     
 
     // Método para excluir um comentário
     public function deleteComment(Comentario $comentario)
{
    // Verifica se o comentário pertence ao usuário autenticado (candidato ou empregador)
    if (
        (auth()->user()->candidato && $comentario->candidato_id != auth()->user()->candidato->id) &&
        (auth()->user()->empregador && $comentario->empregador_id != auth()->user()->empregador->id)
    ) {
        return redirect()->back()->withErrors('Você não tem permissão para excluir este comentário.');
    }

    // Exclui o comentário
    $comentario->delete();

    return back()->with('error', 'Comentário excluído com sucesso.');
}

}
