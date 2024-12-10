@extends('layouts.app')

@section('title', 'Lista de Candidatos')

@section('content')

<div class="container py-4">
    <div class="text-center mb-4">
        <a href="#" class="navbar-brand navbar-brand-autodark">
            <img src="{{ asset('./img/logo.svg') }}" width="110" height="32" alt="Logo" class="navbar-brand-image">
        </a>
    </div>
    <div class="card card-md">
        <div class="card-body">
            <h1 class="card-title">Lista de Candidatos</h1>
            <!-- Botões de Voltar e Adicionar -->
            <div class="d-flex justify-content-end mb-3">
                <a href="#" class="btn btn-success me-2">
                    <i class="fas fa-user-plus me-2"></i> Adicionar Candidato
                </a>
                <a href="{{ route('dashboard') }}" class="btn btn-warning">
                    <i class="fas fa-arrow-left ms-2"></i> Voltar
                </a>
            </div>

            <!-- Mensagem de Sucesso -->
            @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

            

            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Portfólio</th>
                        <th>Verificado</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($candidatos as $candidate)
                        <tr>
                            <td>{{ $candidate->id }}</td>
                            <td>{{ $candidate->user->name }}</td> <!-- Exibe o nome do candidato -->
                            <td>{{ $candidate->user->email }}</td> <!-- Exibe o e-mail do candidato -->
                            <td>{{ $candidate->telefone }}</td> <!-- Exibe o telefone do candidato -->
                            <td>
                                @if (!empty($candidate->portfolio) && filter_var($candidate->portfolio, FILTER_VALIDATE_URL))
                                    <a href="{{ $candidate->portfolio }}" target="_blank">Ver Portfólio</a>
                                @else
                                    Não disponível
                                @endif
                            </td>


                            <td>{{ $candidate->user->email_verified_at ? 'Sim' : 'Não' }}</td>
                            <td>
                                @if ($candidate->ativo === 1)
                                    <span class="badge bg-success text-white">Ativo</span>
                                @else
                                    <span class="badge bg-danger text-white">Inativo</span>
                                @endif
                            </td>
                            <td>
                                <!-- Botões para Editar e Alterar o Status -->
                                <a href="{{ route('candidatos.edit', $candidate->id) }}" class="text-primary"
                                    title="Editar">
                                    <i class="fas fa-edit fa-lg"></i>
                                </a>

                                <!-- Alteração de Status -->
                                <form action="{{ route('candidatos.alterarStatus', $candidate->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-link text-warning" title="Alterar Status">
                                        @if ($candidate->ativo === 1)
                                            <i class="fas fa-ban fa-lg"></i>
                                        @else
                                            <i class="fas fa-check fa-lg"></i>
                                        @endif
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Nenhum candidato encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Paginação -->
            {{ $candidatos->links() }}
        </div>
    </div>
</div>
<script>
    setTimeout(function() {
        let alert = document.querySelector('.alert');
        if (alert) {
            alert.classList.remove('show');
        }
    }, 5000);  // 5000 milissegundos = 5 segundos
</script>

@endsection