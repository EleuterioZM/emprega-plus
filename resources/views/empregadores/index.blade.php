@extends('layouts.app')

@section('title', 'Lista de Empregadores')

@section('content')

<div class="container py-4">
    <div class="text-center mb-4">
        <a href="#" class="navbar-brand navbar-brand-autodark">
            <img src="{{ asset('./img/logo.svg') }}" width="110" height="32" alt="Logo" class="navbar-brand-image">
        </a>
    </div>
    <div class="card card-md">
        <div class="card-body">
            <h1 class="card-title">Lista de Empregadores</h1>
            <!-- Botões de Voltar e Adicionar -->
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('empregadores.create') }}" class="btn btn-success me-2">
                    <i class="fas fa-user-plus me-2"></i> Adicionar Empregador
                </a>
                <a href="{{ route('dashboard') }}" class="btn btn-warning">
                    <i class="fas fa-arrow-left ms-2"></i> Voltar
                </a>
            </div>

            <!-- Mensagem de Sucesso -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Telefone da Empresa</th> <!-- Modificado -->
                        <th>E-mail do Usuário</th> <!-- Modificado -->
                        <th>Empresa</th>
                        <th>Verificado</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($empregadores as $employer)
                        <tr>
                            <td>{{ $employer->id }}</td>
                            <td>{{ $employer->telefone }}</td> <!-- Exibe o telefone da empresa -->
                            <td>{{ $employer->user->email }}</td> <!-- Exibe o e-mail do usuário associado ao empregador -->
                            <td>{{ $employer->company_name }}</td>
                            <td>{{ $employer->email_verified_at ? 'Sim' : 'Não' }}</td>
                            <td>
                                @if ($employer->ativo === 1)
                                    <span class="badge bg-success text-white">Ativo</span>
                                @else
                                    <span class="badge bg-danger text-white">Inativo</span>
                                @endif
                            </td>
                            <td>
                                <!-- Botões para Editar e Alterar o Status -->
                                <a href="{{ route('empregadores.edit', $employer->id) }}" class="text-primary" title="Editar">
                                    <i class="fas fa-edit fa-lg"></i>
                                </a>

                                <!-- Alteração de Status -->
                                <form action="{{ route('empregadores.alterarStatus', $employer->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-link text-warning" title="Alterar Status">
                                        @if ($employer->ativo === 1)
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
                            <td colspan="7" class="text-center">Nenhum empregador encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Paginação -->
            {{ $empregadores->links() }}
        </div>
    </div>
</div>

@endsection
