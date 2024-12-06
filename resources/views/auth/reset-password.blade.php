@extends('layouts.app')

@section('title', 'Redefinir Senha')

@section('content')
<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="." class="navbar-brand navbar-brand-autodark">
                <img src="{{ asset('./img/Empregue.png') }}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
        </div>
        <form class="card card-md" action="{{ route('password.update') }}" method="POST" autocomplete="off" novalidate>
            @csrf
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Redefinir Senha</h2>

                <div class="mb-3">
                    <label class="form-label" for="email">E-mail</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', request()->query('email')) }}" placeholder="Enter your email" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="verification_code">Código de Verificação</label>
                    <input id="verification_code" type="text" class="form-control @error('verification_code') is-invalid @enderror" name="verification_code" value="{{ old('verification_code') }}" placeholder="Enter verification code" required>
                    @error('verification_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password">Nova Senha</label>
                    <div class="input-group input-group-flat">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter new password" autocomplete="off" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password_confirmation">Confirme a Nova Senha</label>
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Confirm new password" required>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Redefinir Senha</button>
                </div>
            </div>
        </form>
        <div class="text-center text-secondary mt-3">
            <a href="{{ route('login') }}" tabindex="-1">Voltar para o login</a>
        </div>
    </div>
</div>
@endsection
