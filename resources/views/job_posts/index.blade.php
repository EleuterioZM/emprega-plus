@extends('layouts.app')

@section('title', 'Lista de Vagas')

@section('content')

<div class="container py-4">
    <div class="text-center mb-4">
        <a href="#" class="navbar-brand navbar-brand-autodark">
            <img src="{{ asset('./img/logo.svg') }}" width="110" height="32" alt="Logo" class="navbar-brand-image">
        </a>
    </div>
    <div class="card card-md">
        <div class="card-body">
            <h1 class="card-title">Lista de Vagas</h1>
            <!-- Botões de Voltar e Adicionar -->
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('job_posts.create') }}" class="btn btn-success me-2">
                    <i class="fas fa-plus-circle me-2"></i> Criar Nova Vaga
                </a>
                <a href="{{ route('dashboard') }}" class="btn btn-warning">
                    <i class="fas fa-arrow-left ms-2"></i> Voltar
                </a>
            </div>

            @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif (session('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif (session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Localização</th>
                        <th>Tipo</th>
                        <th>Salário</th>
                        <th>Validade</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jobPosts as $jobPost)
                        <tr>
                            <td>{{ $jobPost->id }}</td>
                            <td>{{ $jobPost->titulo }}</td>
                            <td>{{ $jobPost->localizacao }}</td>
                            <td>{{ ucfirst($jobPost->tipo) }}</td>
                            <td>
                                {{ $jobPost->salario ? 'MZN ' . number_format($jobPost->salario, 2, ',', '.') : 'N/A' }}
                            </td>
                            <td>
                                {{ $jobPost->validade ? \Carbon\Carbon::parse($jobPost->validade)->format('d/m/Y') : 'Data inválida' }}
                            </td>

                            <td>
                                @if ($jobPost->ativo)
                                    <span class="badge bg-success text-white">Ativo</span>
                                @else
                                    <span class="badge bg-danger text-white">Inativo</span>
                                @endif
                            </td>
                            <td>
                                <!-- Botões para Editar e Alterar o Status -->
                                <a href="{{ route('job_posts.edit', $jobPost->id) }}" class="text-primary me-2" title="Editar">
                                    <i class="fas fa-edit fa-lg"></i>
                                </a>
                                
                                <a href="{{ route('job_posts.show', $jobPost->id) }}" class="text-success me-2" title="Ver Detalhes">
                                    <i class="fas fa-eye fa-lg"></i>
                                </a>

                                <!-- Alteração de Status -->
                                <form action="{{ route('job_posts.alterarStatus', $jobPost->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-link text-warning" title="Alterar Status">
                                        @if ($jobPost->ativo)
                                            <i class="fas fa-ban fa-lg"></i>
                                        @else
                                            <i class="fas fa-check fa-lg"></i>
                                        @endif
                                    </button>
                                </form>

                                <!-- Apagar -->
                                <!--
                                <form action="{{ route('job_posts.destroy', $jobPost->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger" title="Apagar"
                                        onclick="return confirm('Tem a certeza que deseja apagar esta vaga?')">
                                        <i class="fas fa-trash fa-lg"></i>
                                    </button>
                                </form>
                                -->
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Nenhuma vaga encontrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Paginação -->
            {{ $jobPosts->links() }}
        </div>
    </div>
</div>

<script>
    setTimeout(function () {
        let alert = document.querySelector('.alert');
        if (alert) {
            alert.classList.remove('show');
        }
    }, 5000);  // 5000 milissegundos = 5 segundos
</script>

@endsection
