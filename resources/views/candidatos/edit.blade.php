@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Editar Perfil do Candidato</h3>

    <form action="{{ route('candidatos.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Foto de Perfil -->
        <div class="form-group">
            <label for="foto">Foto de Perfil</label>
            <input type="file" class="form-control" name="foto" id="foto" onchange="previewImage(event)">
            
            <!-- Pré-visualização da Foto -->
            @if(!empty($candidato) && $candidato->foto)
                <img id="preview" src="{{ asset('storage/' . $candidato->foto) }}" alt="Foto de Perfil" class="mt-2" style="max-width: 150px;">
            @else
                <img id="preview" src="{{ asset('images/default-avatar.png') }}" alt="Foto de Perfil" class="mt-2" style="max-width: 150px;">
            @endif
        </div>

        <!-- Descrição -->
        <div class="form-group mt-3">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" name="descricao" id="descricao" rows="3">{{ old('descricao', $candidato->descricao ?? '') }}</textarea>
        </div>

        <!-- Telefone -->
        <div class="form-group mt-3">
            <label for="telefone">Telefone</label>
            <input type="text" class="form-control" name="telefone" id="telefone" value="{{ old('telefone', $candidato->telefone ?? '') }}">
        </div>

        <!-- Habilidades -->
        <div class="form-group mt-3">
            <label for="habilidades">Habilidades</label>
            <input type="text" class="form-control" name="habilidades" id="habilidades" value="{{ old('habilidades', $candidato->habilidades ?? '') }}">
        </div>

        <button type="submit" class="btn btn-primary mt-4">Salvar Alterações</button>
    </form>
</div>

<script>
    // Função de pré-visualização da imagem
    function previewImage(event) {
        const preview = document.getElementById('preview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
