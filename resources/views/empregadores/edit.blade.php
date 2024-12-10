@extends('layouts.app')

@section('content')
<html lang="pt">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Emprega+ - Editar Perfil do Empregador</title>
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

  <!-- Incluir o script do Algolia Places -->
  <link href="https://cdn.jsdelivr.net/npm/places.js@1.19.0/dist/cdn/places.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0/dist/cdn/places.min.js"></script>

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
          <h2 class="h2 text-center mb-4">Editar Perfil do Empregador</h2>
          <form action="{{ route('empregadores.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Foto de Perfil -->
            <div class="mb-3 text-center">
              <label for="profile_image" class="form-label">Foto de Perfil</label><br>
              <!-- Exibir foto de perfil se houver -->
              <img
                src="{{ isset($empregador) && $empregador->profile_image ? asset('storage/Empregadores_Profile/' . $empregador->profile_image) : asset('images/default-profile.png') }}"
                id="profilePreview" class="profile-image" alt="Foto de Perfil">

              <div>
                <input type="file" class="form-control upload-btn" name="profile_image" id="profile_image"
                  onchange="previewImage()">
              </div>
            </div>
            <!-- Nome da Empresa e Telefone lado a lado -->
            <div class="form-row mb-3">
              <div class="form-group">
                <label for="company_name" class="form-label">Nome da Empresa</label>
                <input type="text" class="form-control" name="company_name" id="company_name"
                  value="{{ old('company_name', $empregador->company_name) }}">
              </div>
              <div class="form-group">
                <label for="telefone" class="form-label">Telefone da Empresa</label>
                <input type="text" class="form-control" name="telefone" id="telefone"
                  value="{{ old('telefone', $empregador->telefone) }}">
              </div>
            </div>

            <!-- Site e Localização lado a lado -->
            <div class="form-row mb-3">
              <div class="form-group">
                <label for="site" class="form-label">Site da Empresa</label>
                <input type="url" class="form-control" name="site" id="site"
                  value="{{ old('site', $empregador->site) }}">
              </div>
              <div class="form-group">
                <label for="localizacao" class="form-label">Localização da Empresa</label>
                <input type="text" class="form-control" name="localizacao" id="localizacao"
                  value="{{ old('localizacao', $empregador->localizacao) }}" placeholder="Digite a localização" />
              </div>
            </div>

            <!-- Endereço e Descrição com largura total -->
            <div class="full-width mb-3">
              <label for="endereco" class="form-label">Endereço da Empresa</label>
              <input type="text" class="form-control" name="endereco" id="endereco"
                value="{{ old('endereco', $empregador->endereco) }}">
            </div>

            <div class="full-width mb-3">
              <label for="empresa_descricao" class="form-label">Descrição da Empresa</label>
              <textarea class="form-control" name="empresa_descricao" id="empresa_descricao"
                rows="3">{{ old('empresa_descricao', $empregador->empresa_descricao) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
          </form>
          <!-- Botão Voltar -->
          <a href="{{ route('empregadores.index') }}" class="btn btn-warning btn-back mt-3">
            <i class="fas fa-arrow-left"></i> Voltar
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>
  <script src="{{ asset('dist/js/demo.min.js') }}" defer></script>

  <script>
    // Função para pré-visualizar a imagem
    function previewImage() {
      const file = document.getElementById('profile_image').files[0];
      const reader = new FileReader();

      reader.onloadend = function () {
        const imgPreview = document.getElementById('profilePreview');
        imgPreview.src = reader.result;
      }

      if (file) {
        reader.readAsDataURL(file);
      }
    }

    document.addEventListener('DOMContentLoaded', function () {
      // Inicializar o Algolia Places
      var placesAutocomplete = places({
        appId: '{{ env('ALGOLIA_APP_ID') }}', // Acessando a variável de ambiente para o App ID
        apiKey: '{{ env('ALGOLIA_API_KEY') }}', // Acessando a variável de ambiente para a API Key
        container: document.getElementById('localizacao') // Vinculando ao input de localização
      });

      // Opcional: Adicionar um evento de seleção de endereço
      placesAutocomplete.on('change', function (e) {
        document.getElementById('localizacao').value = e.suggestion.value;
      });
    });
  </script>
</body>

</html>
@endsection