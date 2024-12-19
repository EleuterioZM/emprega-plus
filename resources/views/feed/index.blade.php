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
                        {{ $jobPost->salario ? 'MZN ' . number_format($jobPost->salario, 2, ',', '.') : 'N/A' }}</li>
                    <li><strong>Validade:</strong> {{ \Carbon\Carbon::parse($jobPost->validade)->format('d/m/Y') }}</li>
                </ul>

                <!-- Botões de Ação -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    @if (!in_array($jobPost->id, $userCandidaturas))
                        <form action="{{ route('feed.candidatar', $jobPost->id) }}" method="POST" class="me-2">
                            @csrf
                            <button type="submit" class="btn btn-primary">Candidatar-se</button>
                        </form>
                    @else
                        <button class="btn btn-secondary me-2" disabled>Candidatura Enviada</button>
                    @endif

                    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                        data-bs-target="#jobDetailsModal{{ $jobPost->id }}">
                        <i class="fas fa-info-circle"></i> Mais Detalhes
                    </button>
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
            <span class="material-icons {{ in_array($jobPost->id, $userLikes) ? 'text-primary' : 'text-muted' }}"
                style="font-size: 32px;">thumb_up</span>
            <span id="like-count-{{ $jobPost->id }}" class="ms-2">{{ $jobPost->likes->count() }}</span>
        </button>
    </form>

    <!-- Botão Comentar -->
    <button type="button" class="btn p-0 border-0 text-success" data-bs-toggle="collapse"
        data-bs-target="#commentSection{{ $jobPost->id }}" style="background: none;">
        <span class="material-icons text-success" style="font-size: 32px;">comment</span>
        <span id="comment-count-{{ $jobPost->id }}" class="ms-2">{{ $jobPost->comentarios->count() }}</span>
    </button>
</div>


            <!-- Área de Comentários -->
            <div id="commentSection{{ $jobPost->id }}" class="collapse card-footer bg-light">
                <h6 class="text-primary mb-3">Comentários</h6>

                <!-- Comentários Existentes -->
                <div class="mb-3">
                    @forelse ($jobPost->comentarios as $comentario)
                        <div class="d-flex mb-3">
                            <div class="me-2">
                                <img src="{{ $comentario->candidato->foto ? asset('storage/Candidatos_Fotos/' . $comentario->candidato->foto) : asset('img/user-placeholder.png') }}"
                                    alt="Avatar de {{ $comentario->candidato->user->name }}" class="rounded-circle"
                                    style="width: 45px; height: 45px; object-fit: cover;">
                            </div>
                            <div>
                                <p><strong>{{ $comentario->candidato->user->username ?? 'Usuário Desconhecido' }}</strong>
                                </p>
                                <p class="mb-1">{{ $comentario->comentario }}</p>
                                <small class="text-muted">{{ $comentario->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Nenhum comentário ainda. Seja o primeiro!</p>
                    @endforelse
                </div>

                <!-- Formulário de Comentário -->
                <form action="{{ route('feed.comentar', $jobPost->id) }}" method="POST">
                    @csrf
                    <div class="d-flex align-items-center">
                        <img src="{{ auth()->user()->candidato->foto ? asset('storage/Candidatos_Fotos/' . auth()->user()->candidato->foto) : asset('img/user-placeholder.png') }}"
                            alt="Avatar de {{ auth()->user()->name }}" class="rounded-circle me-2"
                            style="width: 45px; height: 45px; object-fit: cover;">
                        <textarea name="comentario" class="form-control me-2" placeholder="Escreva um comentário..."
                            rows="1" required></textarea>
                        <button type="submit" class="btn btn-info text-white">Enviar</button>
                    </div>
                </form>
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
                                <li><strong>Localização:</strong> {{ $jobPost->localizacao }}</li>
                                <li><strong>Salário:</strong>
                                    {{ $jobPost->salario ? 'MZN ' . number_format($jobPost->salario, 2, ',', '.') : 'N/A' }}
                                </li>
                                <li><strong>Validade:</strong>
                                    {{ \Carbon\Carbon::parse($jobPost->validade)->format('d/m/Y') }}</li>
                            </ul>
                            @if($jobPost->documento_pdf)
                                <a href="{{ asset('storage/' . $jobPost->documento_pdf) }}" class="btn btn-primary"
                                    target="_blank">
                                    <i class="fas fa-file-pdf"></i> Ver PDF Completo
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
                                    <p><strong>Nome:</strong> {{ $jobPost->empregador->user->username ?? 'N/A' }}</p>
                                    <p><strong>Email:</strong> {{ $jobPost->empregador->user->email }}</p>
                                    <p><strong>Empresa:</strong> {{ $jobPost->empregador->company_name }}</p>
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
        button.addEventListener('submit', function(event) {
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
