<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'foto',
        'descricao',
        'telefone',
        'habilidades',
        'cv',
        'portfolio',
        'ativo',      // Status (ativo ou desativado)
    ];
    

    // Relacionamento com a tabela 'users'
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
