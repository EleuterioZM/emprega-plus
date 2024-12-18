@extends('layouts.app')

@section('content')
<html lang="pt">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Emprega+ - Editar Vaga</title>
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
          <h2 class="h2 text-center mb-4">Editar Vaga de Emprego</h2>
          <form action="{{ route('job_posts.update', $jobPost->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Título da Vaga -->
            <div class="mb-3 full-width">
              <label for="titulo" class="form-label">Título da Vaga</label>
              <input type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" id="titulo" value="{{ old('titulo', $jobPost->titulo) }}">
              @error('titulo')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Localização e Tipo de Contratação (Metade para cada um) -->
            <div class="form-row mb-3">
              <div class="form-group half-width">
                <label for="localizacao" class="form-label">Localização</label>
                <input type="text" class="form-control @error('localizacao') is-invalid @enderror" name="localizacao" id="localizacao" value="{{ old('localizacao', $jobPost->localizacao) }}" placeholder="Digite a localização" />
                @error('localizacao')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group half-width">
                <label for="tipo" class="form-label">Tipo de Contratação</label>
                <select class="form-control @error('tipo') is-invalid @enderror" name="tipo" id="tipo">
                  <option value="tempo integral" {{ old('tipo', $jobPost->tipo) == 'tempo integral' ? 'selected' : '' }}>Tempo Integral</option>
                  <option value="meio período" {{ old('tipo', $jobPost->tipo) == 'meio período' ? 'selected' : '' }}>Meio Período</option>
                  <option value="freelance" {{ old('tipo', $jobPost->tipo) == 'freelance' ? 'selected' : '' }}>Freelance</option>
                </select>
                @error('tipo')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <!-- Salário e Data de Validade (Metade para cada um) -->
            <div class="form-row mb-3">
              <div class="form-group half-width">
                <label for="salario" class="form-label">Salário</label>
                <input type="text" class="form-control @error('salario') is-invalid @enderror" name="salario" id="salario" value="{{ old('salario', $jobPost->salario) }}">
                @error('salario')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group half-width">
                <label for="validade" class="form-label">Data de Validade</label>
                <input type="date" class="form-control @error('validade') is-invalid @enderror" name="validade" id="validade" value="{{ old('validade', $jobPost->validade) }}">
                @error('validade')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <!-- Documento PDF -->
            <div class="mb-3 full-width">
              <label for="documento_pdf" class="form-label">Documento PDF (opcional)</label>
              <input type="file" class="form-control @error('documento_pdf') is-invalid @enderror" name="documento_pdf" id="documento_pdf">
              @error('documento_pdf')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Descrição da Vaga -->
            <div class="mb-3 full-width">
              <label for="descricao" class="form-label">Descrição da Vaga</label>
              <textarea class="form-control @error('descricao') is-invalid @enderror" name="descricao" id="descricao" rows="4">{{ old('descricao', $jobPost->descricao) }}</textarea>
              @error('descricao')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Ativo -->
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="ativo" id="ativo" {{ old('ativo', $jobPost->ativo) ? 'checked' : '' }}>
              <label class="form-check-label" for="ativo">Ativo</label>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Atualizar Vaga</button>
          </form>

          <!-- Botão Voltar -->
          <a href="{{ route('job_posts.index') }}" class="btn btn-warning btn-back mt-3">
            <i class="fas fa-arrow-left"></i> Voltar
          </a>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>
  <script src="{{ asset('dist/js/demo.min.js') }}" defer></script>

</body>

</html>
@endsection
