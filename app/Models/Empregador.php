<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empregador extends Model
{
    use HasFactory;

    // Definindo explicitamente o nome da tabela
    protected $table = 'empregadores'; // Nome da tabela no banco de dados

    // Campos que podem ser atribuídos em massa
    protected $fillable = [
        'user_id',  // ID do usuário relacionado
        'empresa_nome',  // Nome da empresa
    ];

    // Relacionamento: um Empregador pertence a um User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
