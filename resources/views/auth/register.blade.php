@extends('layouts.app')

@section('title', 'Registro')

@section('content')
<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
        <a href="." class="navbar-brand navbar-brand-autodark">
    <img src="{{ asset('./img/Empregue.png') }}" width="300" height="100" alt="Empregue+" class="navbar-brand-image">
</a>

        </div>
        <form class="card card-md" action="{{ route('register') }}" method="POST" autocomplete="off" novalidate>
            @csrf
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Criar nova conta</h2>

                <!-- Exibição de erros gerais -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="mb-3">
                    <label class="form-label" for="username">Username</label>
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Enter username" required>
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter email" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Tipo de Usuário -->
                <div class="mb-3">
                    <label class="form-label" for="user_type">Tipo de Usuário</label>
                    <select id="user_type" class="form-select @error('user_type') is-invalid @enderror" name="user_type" required>
                        <option value="" disabled selected>Selecione o tipo de usuário</option>
                        <option value="candidato" {{ old('user_type') == 'candidato' ? 'selected' : '' }}>Candidato</option>
                        <option value="empregador" {{ old('user_type') == 'empregador' ? 'selected' : '' }}>Empregador</option>
                    </select>
                    @error('user_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Campos Específicos do Candidato -->
                <div id="candidato_fields" class="user-specific-fields" style="display: none;">
                    <div class="mb-3">
                        <label class="form-label" for="cv">Upload de CV</label>
                        <input type="file" id="cv" class="form-control" name="cv" accept=".pdf,.doc,.docx" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="portfolio">Portfólio/Links (Opcional)</label>
                        <input id="portfolio" type="text" class="form-control" name="portfolio" placeholder="Ex: LinkedIn, GitHub">
                    </div>
                </div>

                <!-- Campos Específicos do Empregador -->
                <div id="empregador_fields" class="user-specific-fields" style="display: none;">
                    <div class="mb-3">
                        <label class="form-label" for="company_name">Nome da Empresa</label>
                        <input id="company_name" type="text" class="form-control" name="company_name" placeholder="Nome da sua empresa" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group input-group-flat">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" autocomplete="off" required>
                        <span class="input-group-text">
                            <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6" />
                                </svg>
                            </a>
                        </span>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password_confirmation">Confirmar Senha</label>
                    <div class="input-group input-group-flat">
                        <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Confirmar senha" autocomplete="off" required>
                        <span class="input-group-text">
                            <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6" />
                                </svg>
                            </a>
                        </span>
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-check">
                        <input type="checkbox" class="form-check-input" name="terms" id="terms" required />
                        <span class="form-check-label">Concordo com os <a href="./terms-of-service.html" tabindex="-1">termos e políticas</a>.</span>
                    </label>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">
                        Criar nova conta
                    </button>
                </div>
            </div>
        </form>

        <div class="text-center text-muted">
            Já tem uma conta? <a href="{{ route('login') }}" tabindex="-1">Entrar</a>
        </div>
    </div>
</div>

<script>
    const userTypeSelect = document.getElementById('user_type');
    const candidatoFields = document.getElementById('candidato_fields');
    const empregadorFields = document.getElementById('empregador_fields');

    userTypeSelect.addEventListener('change', () => {
        if (userTypeSelect.value === 'candidato') {
            candidatoFields.style.display = 'block';
            empregadorFields.style.display = 'none';
        } else if (userTypeSelect.value === 'empregador') {
            candidatoFields.style.display = 'none';
            empregadorFields.style.display = 'block';
        }
    });
</script>
@endsection
