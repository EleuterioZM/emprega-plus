<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Candidato;  // Adiciona a importação para o modelo Candidato
use App\Models\Empregador; // Adiciona a importação para o modelo Empregador

class User extends Authenticatable

{
    use HasFactory, Notifiable;



    protected $fillable = [
        'username',
        'email',
        'password',
       
        'verification_code',
        'user_type', // Campo 'user_type'
        'status', // Novo campo 'status'
       
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function jobPosts()
    {
        return $this->hasMany(JobPost::class, 'empregador_id');
    }

    /**
     * Relacionamento um para muitos com as candidaturas.
     */
    public function applications()
    {
        return $this->hasMany(Application::class, 'candidato_id');
    }
    public function candidato()
    {
        return $this->hasOne(Candidato::class);  // Relacionamento de um para um (candidato por usuário)
    }
    
    public function empregador()
    {
        return $this->hasOne(Empregador::class); // Relacionamento de um para um (empregador por usuário)
    }
    
    
}