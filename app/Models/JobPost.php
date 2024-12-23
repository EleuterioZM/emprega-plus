<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class JobPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'empregador_id',
        'titulo',
        'descricao',
        'localizacao',
        'tipo',
        'salario',
        'documento_pdf',
        'validade',
        'ativo',
    ];

    protected $dates = ['validade']; // Isso garante que a validade seja tratada como uma instância de Carbon

    public function empregador()
    {
        return $this->belongsTo(Empregador::class);
    }
    public function likes()
{
    return $this->hasMany(JobPostLike::class);
}

public function comentarios()
{
    return $this->hasMany(Comentario::class);
}
public function candidaturas()
{
    return $this->hasMany(Candidatura::class, 'job_post_id'); // A chave estrangeira em Candidatura
}
}
