<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidatoController extends Controller
{
    public function edit()
    {
        // Buscar dados do candidato logado
        $candidato = Candidato::where('user_id', Auth::id())->first();

        // Verifica se o candidato existe
        if (!$candidato) {
            return redirect()->route('dashboard')->with('error', 'Candidato não encontrado');
        }

        return view('candidatos.edit', compact('candidato'));
    }
    

    public function update(Request $request)
    {
        // Validação dos dados do candidato
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'descricao' => 'nullable|string|max:500',
            'telefone' => 'nullable|string|max:15',
            'habilidades' => 'nullable|string|max:255',
        ]);

        $candidato = Candidato::where('user_id', Auth::id())->first();

        // Verifica se o candidato existe
        if (!$candidato) {
            return redirect()->route('dashboard')->with('error', 'Candidato não encontrado');
        }

        // Atualizar os dados do candidato
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('candidatos_fotos', 'public');
            $candidato->foto = $fotoPath;
        }

        $candidato->descricao = $request->descricao;
        $candidato->telefone = $request->telefone;
        $candidato->habilidades = $request->habilidades;

        $candidato->save();

        return redirect()->route('candidatos.edit')->with('success', 'Perfil atualizado com sucesso!');
    }
}
