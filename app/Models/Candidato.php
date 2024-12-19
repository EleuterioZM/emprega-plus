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
    public function candidaturas()
{
    return $this->hasMany(Candidatura::class, 'candidato_id');
}
public function likes()
{
    return $this->hasMany(JobPostLike::class, 'candidato_id');
}
public function comentarios()
{
    return $this->hasMany(Comentario::class, 'candidato_id');
}

}
