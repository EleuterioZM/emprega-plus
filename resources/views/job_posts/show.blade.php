@extends('layouts.app')

@section('content')
<html lang="pt">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Emprega+ - Detalhes da Vaga</title>
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
          <h2 class="h2 text-center mb-4">{{ $jobPost->titulo }}</h2>

          <!-- Formulário de detalhes, sem edição -->
          <form>
            <!-- Título da Vaga -->
            <div class="mb-3 full-width">
              <label for="titulo" class="form-label">Título da Vaga</label>
              <input type="text" class="form-control" id="titulo" value="{{ $jobPost->titulo }}" disabled>
            </div>

            <!-- Localização e Tipo de Contratação -->
            <div class="form-row mb-3">
              <div class="form-group half-width">
                <label for="localizacao" class="form-label">Localização</label>
                <input type="text" class="form-control" id="localizacao" value="{{ $jobPost->localizacao }}" disabled>
              </div>

              <div class="form-group half-width">
                <label for="tipo" class="form-label">Tipo de Contratação</label>
                <input type="text" class="form-control" id="tipo" value="{{ $jobPost->tipo }}" disabled>
              </div>
            </div>

            <!-- Salário e Data de Validade -->
            <div class="form-row mb-3">
              <div class="form-group half-width">
                <label for="salario" class="form-label">Salário</label>
                <input type="text" class="form-control" id="salario" value="{{ $jobPost->salario }}" disabled>
              </div>

              <div class="form-group half-width">
                <label for="validade" class="form-label">Data de Validade</label>
                <input type="text" class="form-control" id="validade" value="{{ $jobPost->validade }}" disabled>
              </div>
            </div>

            <!-- Documento PDF -->
            @if($jobPost->documento_pdf)
  <div class="mb-3 full-width">
    <label for="documento_pdf" class="form-label">Documento PDF</label>
    <a href="{{ asset('storage/JobPosts_Documents/'.$jobPost->documento_pdf) }}" target="_blank" class="btn btn-primary">
      Ver Documento
    </a>
  </div>
@endif


            <!-- Descrição da Vaga -->
            <div class="mb-3 full-width">
              <label for="descricao" class="form-label">Descrição da Vaga</label>
              <textarea class="form-control" id="descricao" rows="4" disabled>{{ $jobPost->descricao }}</textarea>
            </div>

            <!-- Status (Ativo) -->
            <div class="mb-3 full-width">
              <label for="ativo" class="form-label">Status</label>
              <input type="text" class="form-control" id="ativo" value="{{ $jobPost->ativo ? 'Ativo' : 'Inativo' }}" disabled>
            </div>

            <!-- Botão Voltar -->
            <a href="{{ route('job_posts.index') }}" class="btn btn-warning btn-back mt-3">
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
