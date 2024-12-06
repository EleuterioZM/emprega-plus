@extends('layouts.app')

@section('title', 'Esqueceu sua Senha?')

@section('content')
<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="." class="navbar-brand navbar-brand-autodark">
                <img src="{{ asset('./img/Empregue.png') }}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
        </div>
        <form class="card card-md" action="{{ route('password.email') }}" method="POST" autocomplete="off" novalidate>
            @csrf
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Esqueceu sua senha?</h2>

                <div class="mb-3">
                    <label class="form-label" for="email">E-mail</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter your email" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" /><path d="M3 7l9 6l9 -6" /></svg>    
                    Enviar Código de Verificação</button>
                </div>
            </div>
        </form>
        <div class="text-center text-secondary mt-3">
            <a href="{{ route('login') }}" tabindex="-1">Voltar para o login</a>
        </div>
    </div>
</div>
@endsection
