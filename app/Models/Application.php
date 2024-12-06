<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    // Defina os campos que podem ser preenchidos diretamente
    protected $fillable = ['job_id', 'candidato_id', 'status'];

    /**
     * Relacionamento inverso com a vaga.
     */
    public function jobPost()
    {
        return $this->belongsTo(JobPost::class, 'job_id');
    }

    /**
     * Relacionamento inverso com o candidato.
     */
    public function candidate()
    {
        return $this->belongsTo(User::class, 'candidato_id');
    }
}
