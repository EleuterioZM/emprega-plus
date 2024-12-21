<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidatura extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidato_id',
        'job_post_id',
        'carta_candidatura',
        'anexo',
    ];

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }

    public function candidato()
    {
        return $this->belongsTo(Candidato::class);
    }
    
}
