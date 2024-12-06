@extends('layouts.app')

@section('title', 'Verificar Email')

@section('content')
<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="." class="navbar-brand navbar-brand-autodark">
                <img src="{{ asset('./img/Empregue.png') }}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
        </div>
        
      <!-- Mostrar mensagem de sucesso ou erro -->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form class="card card-md" action="{{ route('verification.verify') }}" method="POST" autocomplete="off" novalidate>
    @csrf
    <!-- Garantindo que o email seja preenchido corretamente -->
    <input type="hidden" name="email" value="{{ old('email', session('email', '')) }}">
    <div class="card-body">
        <h2 class="card-title text-center mb-4">Verificar Conta</h2>

        <div class="mb-3">
            <label class="form-label" for="verification_code">Código de Verificação</label>
            <input id="verification_code" type="text" class="form-control @error('verification_code') is-invalid @enderror" name="verification_code" placeholder="Digite o código de verificação" value="{{ old('verification_code') }}" required>
            @error('verification_code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">
                <span style="margin-right: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-check-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                    </svg>
                </span>
                Verificar
            </button>
        </div>
    </div>
</form>

<div class="text-center text-secondary mt-3">
    <a href="{{ route('login') }}" tabindex="-1">Voltar para o login</a>
</div>

    </div>
</div>
@endsection
