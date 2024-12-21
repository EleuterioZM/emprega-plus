@extends('layouts.app')

@section('content')
<html lang="pt">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Emprega+ - Meu Perfil</title>
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/demo.min.css') }}" rel="stylesheet" />
    <style>
        .form-control {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
        }

        .container-tight {
            max-width: 700px;
        }

        .btn-primary {
            width: 100%;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .form-row .form-group {
            flex: 1 1 48%;
        }

        .form-row .form-control {
            max-width: 100%;
        }

        .full-width {
            max-width: 100%;
        }

        .btn-back {
            width: auto;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #f8f9fa;
            color: #007bff;
            border-color: #007bff;
        }

        .half-width {
            flex: 1 1 48%;
        }

        .full-width {
            flex: 1 1 100%;
        }

        /* Estilos para a foto de perfil circular e centralizada */
        .profile-image {
            width: 150px;
            /* Defina o tamanho desejado para a imagem */
            height: 150px;
            /* Deve ser igual ao tamanho da largura para garantir que seja uma forma circular */
            object-fit: cover;
            /* Isso garantirá que a imagem se ajuste corretamente */
            border-radius: 50%;
            /* Torna a imagem circular */
            display: block;
            /* Centraliza a imagem */
            margin: 0 auto;
            /* Garante que a imagem fique centralizada */
        }
    </style>
</head>

<body class="d-flex flex-column">
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark">
                    <img src="{{ asset('') }}" width="110" height="32" alt="Emprega+" class="navbar-brand-image">
                </a>
            </div>
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">Meu Perfil</h2>
                    <hr>
                    <!-- Formulário de perfil, sem edição -->
                    <form>
                        @if(auth()->user()->user_type == 'candidato')
                            <h2>Perfil de Candidato</h2>

                            <!-- Foto de perfil do candidato -->
                            <div class="mb-3 full-width  text-center mb-3">

                                @if($perfil->foto)
                                    <img src="{{ asset('storage/Candidatos_Fotos/' . $perfil->foto) }}" id="profilePreview"
                                        class="profile-image" alt="Foto de Perfil">
                                    <label for="foto" class="form-label">Foto de Perfil</label>
                                @else
                                    <p>Foto não disponível</p>
                                @endif
                            </div>



                            <div class="mb-3 full-width">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" value="{{ auth()->user()->username }}"
                                    disabled>
                            </div>
                            <div class="form-row mb-3">
                                <div class="form-group half-width">
                                    <label for="telefone" class="form-label">Telefone</label>
                                    <input type="text" class="form-control" id="telefone" value="{{ $perfil->telefone }}"
                                        disabled>
                                </div>
                                <div class="form-group half-width">
                                    <label for="habilidades" class="form-label">Habilidades</label>
                                    <input type="text" class="form-control" id="habilidades"
                                        value="{{ $perfil->habilidades }}" disabled>
                                </div>
                            </div>


                            <!-- Novo campo para Endereço -->
                            <div class="mb-3 full-width">
                                <label for="endereco" class="form-label">Email do Candidato</label>
                                <input type="text" class="form-control" id="endereco" value="{{ $perfil->user->email }}"
                                    disabled>
                            </div>





                            <div class="form-row mb-3">
                                <div class="form-group full-width">
                                    <label for="descricao" class="form-label">Descrição</label>
                                    <textarea class="form-control" id="descricao" rows="4"
                                        disabled>{{ $perfil->descricao }}</textarea>
                                </div>
                            </div>
                            <div class="mb-3 full-width">
                                <label for="cv" class="form-label">Currículo e Portfólio</label>
                                <div class="row">
                                    <!-- Botão Ver CV -->
                                    <div class="col-md-6 mb-3">
                                        <a href="{{ asset('storage/Candidatos_CVs/' . $perfil->cv) }}" target="_blank"
                                            class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
                                            <i class="fa fa-eye me-2"></i> Ver CV
                                        </a>
                                    </div>

                                    <!-- Botão Ver Portfolio -->
                                    <div class="col-md-6 mb-3">
                                        <a href="{{ $perfil->portfolio }}" target="_blank"
                                            class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
                                            <i class="fa fa-eye me-2"></i> Ver Portfolio
                                        </a>
                                    </div>
                                </div>
                            </div>



                        @elseif(auth()->user()->user_type == 'empregador')
                            <h2>Perfil de Empregador</h2>

                            <div class="profile-container text-center mb-3">
                                @if($perfil->profile_image)
                                    <img src="{{ asset('storage/Empregadores_Profile/' . $perfil->profile_image) }}"
                                        alt="Foto de Perfil" class="profile-image">
                                    <label for="profile_image" class="form-label">Foto de Perfil</label>
                                @else
                                    <img src="{{ asset('images/default-profile.png') }}" alt="Foto de Perfil"
                                        class="profile-image">
                                    <label for="profile_image" class="form-label">Foto de Perfil</label>
                                @endif
                            </div>


                            <div class="mb-3 full-width">
                                <label for="company_name" class="form-label">Nome da Empresa</label>
                                <input type="text" class="form-control" id="company_name"
                                    value="{{ $perfil->company_name }}" disabled>
                            </div>
                            <div class="form-row mb-3">
                                <div class="form-group half-width">
                                    <label for="telefone" class="form-label">Telefone</label>
                                    <input type="text" class="form-control" id="telefone" value="{{ $perfil->telefone }}"
                                        disabled>
                                </div>
                                <div class="form-group half-width">
                                    <label for="localizacao" class="form-label">Localização</label>
                                    <input type="text" class="form-control" id="localizacao"
                                        value="{{ $perfil->localizacao }}" disabled>
                                </div>
                                <div class="form-row mb-3">




                                    <div class="form-row mb-3">
                                        <div class="form-group half-width">
                                            <label for="nome" class="form-label">Nome do Empregador</label>
                                            <input type="text" class="form-control" id="telefone"
                                                value="{{ $perfil->user->username }}" disabled>
                                        </div>
                                        <div class="form-group half-width">
                                            <label for="email" class="form-label">Email do Empregador</label>
                                            <input type="text" class="form-control" id="email"
                                                value="{{ $perfil->user->email }}" disabled>
                                        </div>


                                        <!-- Novo campo para Endereço -->
                                        <div class="mb-3 full-width">
                                            <label for="endereco" class="form-label">Endereço</label>
                                            <input type="text" class="form-control" id="endereco"
                                                value="{{ $perfil->endereco }}" disabled>
                                        </div>



                                        <div class="mb-3 full-width">
                                            <label for="empresa_descricao" class="form-label">Descrição da Empresa</label>
                                            <textarea class="form-control full-width" id="empresa_descricao" rows="4"
                                                disabled>{{ $perfil->empresa_descricao }}</textarea>
                                        </div>


                                        <div class="mb-3 full-width">
                                            <label for="site" class="form-label">Website</label>
                                            <a href="{{ $perfil->site }}" target="_blank" class="btn btn-primary">
                                                Visitar
                                            </a>
                                        </div>
                        @endif
                                    <!-- Estado do perfil -->
                                    <div class="mb-3 full-width">
                                        @if ($perfil->ativo === 1)
                                            <label for="site" class="form-label">Estado do perfil</label>
                                            <span class="badge bg-success text-white">Ativo</span>
                                        @else
                                            <span class="badge bg-danger text-white">Inativo</span>
                                        @endif
                                    </div>



                                    <!-- Botão Voltar -->
                                    <a href="{{ route('dashboard') }}" class="btn btn-warning btn-back mt-3">
                                        <i class="fas fa-arrow-left"></i> Voltar
                                    </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('dist/js/demo.min.js') }}" defer></script>

</body>

</html>
@endsection