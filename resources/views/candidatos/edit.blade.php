@extends('layouts.app')

@section('content')
<html lang="pt">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Emprega+ - Editar Perfil do Candidato</title>
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/demo.min.css') }}" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        /* Estilo personalizado para aumentar a largura dos campos */
        .form-control {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
        }

        .container-tight {
            max-width: 700px;
            /* Tamanho do container central */
        }

        .btn-primary {
            width: 100%;
        }

        /* Estilo para imagem de perfil */
        .profile-image {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .upload-btn {
            display: inline-block;
            margin-top: 10px;
        }

        /* Organizar os campos lado a lado */
        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            /* Espaçamento entre os campos */
        }

        .form-row .form-group {
            flex: 1 1 48%;
            /* Cada campo ocupa 50% do espaço */
        }

        .form-row .form-control {
            max-width: 100%;
        }

        /* Estilo para campos de endereço e descrição */
        .full-width {
            max-width: 100%;
            /* Para garantir que ocupe toda a largura */
        }

        /* Estilo para o botão voltar */
        .btn-back {
            width: auto;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #f8f9fa;
            color: #007bff;
            border-color: #007bff;
        }

        .btn-back i {
            font-size: 16px;
        }
    </style>

</head>

<body>
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">Editar Perfil do Candidato</h2>
                    <form action="{{ route('candidatos.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Foto de Perfil -->
                        <div class="mb-3 text-center">
                            <label for="foto" class="form-label">Foto de Perfil</label>
                            <img src="{{ $candidato->foto ? asset('storage/Candidatos_Fotos/' . $candidato->foto) : asset('images/default-profile.png') }}"
                                id="profilePreview" class="profile-image" alt="Foto de Perfil">

                            <input type="file" class="form-control mt-2" name="foto" id="foto"
                                onchange="previewImage()">
                        </div>


                        <!-- Telefone e Habilidades -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="text" class="form-control" name="telefone" id="telefone"
                                    value="{{ old('telefone', $candidato->telefone) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="habilidades" class="form-label">Habilidades</label>
                                <input type="text" class="form-control" name="habilidades" id="habilidades"
                                    value="{{ old('habilidades', $candidato->habilidades) }}">
                            </div>
                        </div>

                        <!-- Currículo e Portfólio -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cv" class="form-label">Currículo (PDF)</label>
                                <input type="file" class="form-control" name="cv" id="cv">
                                @if ($candidato->cv)
                                    <a href="{{ route('candidatos.download', ['filename' => $candidato->cv]) }}"
                                        class="mt-2 d-block">
                                        Baixar Currículo Atual
                                    </a>

                                @endif



                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="portfolio" class="form-label">Portfólio ou Links</label>
                                <input type="text" class="form-control" name="portfolio" id="portfolio"
                                    value="{{ old('portfolio', $candidato->portfolio) }}">
                            </div>
                        </div>

                        <!-- Habilidades ocupando toda a largura -->
                        <div class="mb-3">
                            <label for="habilidades" class="form-label">Habilidades</label>
                            <input type="text" class="form-control" name="habilidades" id="habilidades"
                                value="{{ old('habilidades', $candidato->habilidades) }}">
                        </div>

                        <!-- Descrição -->
                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição</label>
                            <textarea class="form-control" name="descricao" id="descricao"
                                rows="4">{{ old('descricao', $candidato->descricao) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </form>

                    <!-- Botão Voltar -->
                    <a href="{{ route('candidatos.index') }}" class="btn btn-warning btn-back mt-3">
                        Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('dist/js/demo.min.js') }}" defer></script>

    <script>
        // Pré-visualização da imagem
        function previewImage() {
            const file = document.getElementById('foto').files[0];
            const reader = new FileReader();

            reader.onloadend = function () {
                const imgPreview = document.getElementById('profilePreview');
                imgPreview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>

</html>
@endsection