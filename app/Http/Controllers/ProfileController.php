<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use App\Models\Empregador;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Pega o usuário autenticado

        // Verifica o tipo de usuário e retorna os dados específicos
        if ($user->user_type == 'candidato') {
            $perfil = Candidato::where('user_id', $user->id)->first();
        } else {
            $perfil = Empregador::where('user_id', $user->id)->first();
        }

        return view('perfil.index', compact('perfil'));
    }
}
