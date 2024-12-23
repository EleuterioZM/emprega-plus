@extends('layouts.app')
@section('title', 'Feed de Vagas')
@section('content')
<div class="container py-4">
<div class="text-center mb-4">
   <a href="#" class="navbar-brand navbar-brand-autodark">
   <img src="{{ asset('./img/logo.svg') }}" width="110" height="32" alt="Logo" class="navbar-brand-image">
   </a>
</div>
<!-- Loop de Vagas -->
@foreach ($jobPosts as $jobPost)
<div class="card mb-4 shadow-sm">
<div class="card-body">
   <!-- Cabeçalho da Vaga -->
   <div class="d-flex justify-content-between align-items-center">
      <div>
         <h5 class="card-title mb-0">{{ $jobPost->titulo }}</h5>
         <p><strong>Vaga publicada pelo(a):</strong>
            <i>{{ $jobPost->empregador->user->username ?? 'N/A' }}</i>
         </p>
         <hr>
         <small class="text-muted">
         Publicado em {{ $jobPost->created_at->format('d/m/Y H:i') }}
         </small>
      </div>
      <div>
         <span class="badge bg-primary text-white">{{ ucfirst($jobPost->tipo) }}</span>
      </div>
   </div>
   <!-- Conteúdo Resumido -->
   <ul class="list-unstyled mb-3">
      <li><strong>Localização:</strong> {{ $jobPost->localizacao }}</li>
      <li><strong>Salário:</strong>
         {{ $jobPost->salario ? 'MZN ' . number_format($jobPost->salario, 2, ',', '.') : 'N/A' }}
      </li>
      <li><strong>Validade:</strong> {{ \Carbon\Carbon::parse($jobPost->validade)->format('d/m/Y') }}</li>
   </ul>
   <!-- Botões de Ação -->
   <div class="d-flex justify-content-between align-items-center mt-3">
      @if (!in_array($jobPost->id, $userCandidaturas))
      <button type="button" class="btn btn-primary" data-bs-toggle="modal"
         data-bs-target="#candidatarModal{{ $jobPost->id }}">
      Candidatar-se
      </button>
      @else
      <button class="btn btn-secondary me-2" disabled>Candidatura Enviada</button>
      @endif
      <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
         data-bs-target="#jobDetailsModal{{ $jobPost->id }}">
      <i class="fas fa-info-circle"></i> Mais Detalhes
      </button>
   </div>

   
   <!-- Modal de Candidatura -->
   <div class="modal fade" id="candidatarModal{{ $jobPost->id }}" tabindex="-1"
      aria-labelledby="candidatarModalLabel{{ $jobPost->id }}" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="candidatarModalLabel{{ $jobPost->id }}">Candidatar-se à Vaga</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('feed.candidatar', $jobPost->id) }}" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="modal-body">
                  <h6><strong>{{ $jobPost->titulo }}</strong></h6>
                  <p><strong>Vaga publicada por:</strong> {{ $jobPost->empregador->user->username ?? 'N/A' }}</p>
                  <div class="mb-3">
                     <label for="carta_candidatura" class="form-label">Carta de Candidatura</label>
                     <input type="file" name="carta_candidatura" class="form-control" accept=".pdf,.doc,.docx,.txt" placeholder="Selecione um arquivo de carta de candidatura (opcional)">
                     <small class="form-text text-muted">Formato permitido: PDF, DOC, DOCX, TXT.</small>
                  </div>
                  <div class="mb-3">
                     <label for="anexo" class="form-label">Anexar Arquivo (opcional)</label>
                     <input type="file" class="form-control" name="anexo">
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                  <button type="submit" class="btn btn-primary">Enviar Candidatura</button>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!-- Botão Curtir e Comentar -->
   <div class="card-footer d-flex justify-content-start gap-3">
      <!-- Botão Curtir -->
      <form action="{{ route('feed.like', $jobPost->id) }}" method="POST" class="d-inline-block like-button"
         data-post-id="{{ $jobPost->id }}">
         @csrf
         <button type="submit"
            class="btn p-0 border-0 {{ in_array($jobPost->id, $userLikes) ? 'text-primary' : 'text-muted' }} like-btn"
            id="like-btn-{{ $jobPost->id }}" style="background: none;">
         <span
            class="material-icons {{ in_array($jobPost->id, $userLikes) ? 'text-primary' : 'text-muted' }}"
            style="font-size: 28px;">thumb_up</span>
         <span id="like-count-{{ $jobPost->id }}" class="ms-2">{{ $jobPost->likes->count() }}</span>
         </button>
      </form>
      <!-- Botão Comentar -->
      <button type="button" class="btn p-0 border-0 text-success" data-bs-toggle="collapse"
         data-bs-target="#commentSection{{ $jobPost->id }}" style="background: none;">
      <span class="material-icons text-success" style="font-size: 28px;">comment</span>
      <span id="comment-count-{{ $jobPost->id }}" class="ms-2">{{ $jobPost->comentarios->count() }}</span>
      </button>
   </div>
   <!-- Área de Comentários -->
   <div id="commentSection{{ $jobPost->id }}" class="collapse card-footer bg-light">
      <h6 class="text-primary mb-3">Comentários</h6>
      <!-- Comentários Existentes -->
      <div class="mb-3">
         @forelse ($jobPost->comentarios as $comentario)
         <div class="d-flex mb-3 comment" style="position: relative;">
            <div class="me-2">
               <img src="{{ $comentario->candidato ? 
                  ($comentario->candidato->foto ? asset('storage/Candidatos_Fotos/' . $comentario->candidato->foto) : asset('img/user-placeholder.png')) : 
                  ($comentario->empregador ? 
                  ($comentario->empregador->profile_image ? asset('storage/Empregadores_Profile/' . $comentario->empregador->profile_image) : asset('img/user-placeholder.png')) : 
                  asset('img/user-placeholder.png')
                  ) }}" 
                  alt="Avatar de {{ $comentario->candidato ? $comentario->candidato->user->name : $comentario->empregador->company_name }}" 
                  class="rounded-circle" 
                  style="width: 45px; height: 45px; object-fit: cover;">
            </div>
            <div class="flex-grow-1">
               <p>
                  <strong>
                     @if($comentario->candidato)
                     {{ $comentario->candidato->user->username ?? 'Usuário Desconhecido' }}
                     @elseif($comentario->empregador)
                     {{ $comentario->empregador->user->username ?? 'Usuário Desconhecido' }}
                     (Empregador)
                     @if($comentario->empregador->has_posts)
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" id="verified" style="vertical-align: middle; margin-left: 4px;">
                        <path fill="#4DC4FF" d="M12 1.25C6.06294 1.25 1.25 6.06294 1.25 12C1.25 17.9371 6.06294 22.75 12 22.75C17.9371 22.75 22.75 17.9371 22.75 12C22.75 6.06294 17.9371 1.25 12 1.25Z"></path>
                        <path fill="#ECEFF1" fill-rule="evenodd" d="M18.0303 7.96967C18.3232 8.26256 18.3232 8.73744 18.0303 9.03033L11.0303 16.0303C10.8897 16.171 10.6989 16.25 10.5 16.25C10.3011 16.25 10.1103 16.171 9.96967 16.0303L5.96967 12.0303C5.67678 11.7374 5.67678 11.2626 5.96967 10.9697C6.26256 10.6768 6.73744 10.6768 7.03033 10.9697L10.5 14.4393L16.9697 7.96967C17.2626 7.67678 17.7374 7.67678 18.0303 7.96967Z" clip-rule="evenodd"></path>
                     </svg>
                     @endif
                     @else
                     Usuário Desconhecido
                     @endif
                  </strong>
               <p class="mb-1">{{ $comentario->comentario }}</p>
               <small class="text-muted">{{ $comentario->created_at->diffForHumans() }}</small>
               <!-- Botões Editar e Excluir (aparecem apenas para o autor ao pressionar o comentário) -->
               @if ((auth()->user()->candidato && $comentario->candidato_id == auth()->user()->candidato->id) || 
               (auth()->user()->empregador && $comentario->empregador_id == auth()->user()->empregador->id))
               <div class="comment-icons" style="display: none; gap: 1rem; margin-top: 0.5rem;">
                  <!-- Botão Editar -->
                  <button class="btn btn-sm" style="border: none; background: transparent;"
                     data-bs-toggle="collapse" data-bs-target="#editCommentForm{{ $comentario->id }}">
                  <i class="fas fa-edit" style="font-size: 1.2rem;"></i>
                  </button>
                  <!-- Botão Excluir -->
                  <form action="{{ route('feed.delete_comment', $comentario->id) }}" method="POST"
                     class="d-inline-block">
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="btn btn-sm" style="border: none; background: transparent;">
                     <i class="fas fa-trash text-danger" style="font-size: 1.2rem;"></i>
                     </button>
                  </form>
               </div>
               @endif
               <!-- Formulário de Edição -->
               @if ((auth()->user()->candidato && $comentario->candidato_id == auth()->user()->candidato->id) || 
               (auth()->user()->empregador && $comentario->empregador_id == auth()->user()->empregador->id))
               <div id="editCommentForm{{ $comentario->id }}" class="collapse mt-2">
                  <form action="{{ route('feed.update_comment', $comentario->id) }}" method="POST">
                     @csrf
                     @method('PUT')
                     <textarea name="comentario" class="form-control" rows="2"
                        required>{{ $comentario->comentario }}</textarea>
                     <button type="submit" class="btn btn-info mt-2">Atualizar Comentário</button>
                  </form>
               </div>
               @endif
            </div>
         </div>
         @empty
         <p class="text-muted">Nenhum comentário ainda. Seja o primeiro!</p>
         @endforelse
      </div>
      <!-- JavaScript para Mostrar/Ocultar Ícones -->
      <script>
         document.querySelectorAll('.comment').forEach(comment => {
             comment.addEventListener('click', () => {
                 const editForm = comment.querySelector('.collapse.show'); // Verifica se o formulário de edição está aberto
                 if (!editForm) { // Se não estiver em edição
                     const icons = comment.querySelector('.comment-icons');
                     if (icons) {
                         icons.style.display = icons.style.display === 'none' ? 'flex' : 'none';
                     }
                 }
             });
         });
      </script>
      <!-- Formulário de Comentário -->
      <form id="commentForm{{ $jobPost->id }}" action="{{ route('feed.comentar', $jobPost->id) }}" method="POST">
         @csrf
         <div class="d-flex align-items-center">
            <!-- Foto de Perfil do Usuário -->
            <img src="{{ auth()->user()->candidato ? 
               (auth()->user()->candidato->foto ? asset('storage/Candidatos_Fotos/' . auth()->user()->candidato->foto) : asset('img/user-placeholder.png')) : 
               (auth()->user()->empregador ? 
               (auth()->user()->empregador->profile_image ? asset('storage/Empregadores_Profile/' . auth()->user()->empregador->profile_image) : asset('img/user-placeholder.png')) : 
               asset('img/user-placeholder.png')
               ) }}" 
               alt="Avatar de {{ auth()->user()->candidato ? auth()->user()->candidato->user->name : auth()->user()->empregador->company_name }}" 
               class="rounded-circle" 
               style="width: 45px; height: 45px; object-fit: cover; margin-right: 10px;">
            <!-- Campo de Comentário -->
            <textarea name="comentario" class="form-control me-2" placeholder="Escreva um comentário..." rows="1" required></textarea>
            <!-- Botão Enviar -->
            <button type="submit" class="btn btn-info text-white">
            <i class="fas fa-paper-plane" style="font-size: 1.5rem;"></i>
            </button>
         </div>
      </form>
      <script>
         document.getElementById('commentForm{{ $jobPost->id }}').addEventListener('keypress', function(event) {
             if (event.key === 'Enter' && !event.shiftKey) {  // A tecla Enter foi pressionada sem a tecla Shift
                 event.preventDefault(); // Previne o comportamento padrão de quebra de linha
                 this.submit();  // Submete o formulário
             }
         });
      </script>
   </div>
   <!-- Modal Detalhes da Vaga -->
   <div class="modal fade" id="jobDetailsModal{{ $jobPost->id }}" tabindex="-1"
      aria-labelledby="jobDetailsModalLabel{{ $jobPost->id }}" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="jobDetailsModalLabel{{ $jobPost->id }}">Detalhes da Vaga</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <h6><strong>Título:</strong> {{ $jobPost->titulo }}</h6>
               <p><strong>Descrição:</strong> {{ $jobPost->descricao }}</p>
               <ul class="list-unstyled">
                  <div class="d-flex gap-3">
                     <li><strong>Localização:</strong> {{ $jobPost->localizacao }}</li>
                     <li><strong>Salário:</strong>
                        {{ $jobPost->salario ? 'MZN ' . number_format($jobPost->salario, 2, ',', '.') : 'N/A' }}
                     </li>
                     <li><strong>Validade:</strong>
                        {{ \Carbon\Carbon::parse($jobPost->validade)->format('d/m/Y') }}
                     </li>
                  </div>
               </ul>
               @if($jobPost->documento_pdf)
               <a href="{{ asset('storage/' . $jobPost->documento_pdf) }}" class="btn btn-primary"
                  target="_blank">
               <i class="fas fa-file-pdf ms-2"></i> Ver PDF Completo
               </a>
               @else
               <p>Nenhum PDF disponível para esta vaga.</p>
               @endif
               <hr>
               <h6>Informações do Empregador</h6>
               <div class="d-flex align-items-center">
                  <img src="{{ $jobPost->empregador->profile_image ? asset('storage/Empregadores_Profile/' . $jobPost->empregador->profile_image) : asset('img/user-placeholder.png') }}"
                     alt="Foto do Empregador" class="rounded-circle" width="100" height="100"
                     style="object-fit: cover;">
                  <div class="ms-3">
                     <div class="d-flex justify-content-between">
                        <p><strong>Email:</strong> {{ $jobPost->empregador->user->email }}</p>
                     </div>
                     <div class="d-flex justify-content-between">
                        <p class="me-3"><strong>Nome:</strong>
                           {{ $jobPost->empregador->user->username ?? 'N/A' }}
                        </p>
                        <p class="me-3"><strong>Empresa:</strong> {{ $jobPost->empregador->company_name }}
                        </p>
                        <p><strong>Telefone:</strong> {{ $jobPost->empregador->telefone }}</p>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
               </div>
            </div>
         </div>
      </div>
   </div>
   
   @endforeach
   <!-- Paginação -->
   <div class="d-flex justify-content-center">
      {{ $jobPosts->links() }}
   </div>
</div>
@endsection
@push('scripts')
<script>
   document.querySelectorAll('.like-button').forEach(button => {
       button.addEventListener('submit', function (event) {
           event.preventDefault();
           const postId = this.dataset.postId;
           const likeBtn = document.getElementById(`like-btn-${postId}`);
           const likeCount = document.getElementById(`like-count-${postId}`);
   
           if (likeBtn.classList.contains('btn-outline-primary')) {
               likeBtn.classList.remove('btn-outline-primary');
               likeBtn.classList.add('btn-primary');
               likeCount.textContent = parseInt(likeCount.textContent) + 1;
           } else {
               likeBtn.classList.remove('btn-primary');
               likeBtn.classList.add('btn-outline-primary');
               likeCount.textContent = parseInt(likeCount.textContent) - 1;
           }
       });
   });
   
   
   
</script>
@endpush