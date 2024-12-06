<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cv',
        'portfolio',
    ];

    // Relacionamento com a tabela 'users'
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
