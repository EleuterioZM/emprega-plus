<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    // Defina os campos que podem ser preenchidos diretamente
    protected $fillable = ['title', 'description', 'status', 'empregador_id'];

    /**
     * Relacionamento inverso com o User (empregador).
     */
    public function employer()
    {
        return $this->belongsTo(User::class, 'empregador_id');
    }

    /**
     * Relacionamento um para muitos com as candidaturas.
     */
    public function applications()
    {
        return $this->hasMany(Application::class, 'job_id');
    }
}
