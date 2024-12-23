<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empregador extends Model
{
    use HasFactory;

    protected $table = 'empregadores'; // Nome da tabela no banco de dados

    protected $fillable = [
        'user_id',
        'company_name',
        'empresa_descricao',
        'telefone',
        'site',
        'profile_image',
    ];

    // Relacionamento: um Empregador pertence a um User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacionamento: um Empregador pode ter várias postagens de emprego
    public function jobPosts()
    {
        return $this->hasMany(JobPost::class, 'empregador_id');
    }

    // Relacionamento direto: um Empregador pode ter várias candidaturas
    public function candidaturas()
    {
        return $this->hasMany(Candidatura::class, 'empregador_id');
    }

    // Relacionamento direto: um Empregador pode ter vários likes
    public function likes()
    {
        return $this->hasMany(JobPostLike::class, 'empregador_id');
    }

    // Relacionamento direto: um Empregador pode ter vários comentários
    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'empregador_id');
    }
    // App\Models\Empregador.php
public function getHasPostsAttribute()
{
    return $this->jobPosts()->exists();
}

}
