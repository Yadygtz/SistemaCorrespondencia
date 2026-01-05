<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroNumerosAnt extends Model
{
    use HasFactory;
    protected $table = 'registro_numeros_2025';

    protected $fillable = [
        'numeroId',
        'fecha',
        'area',
        'asunto',
        'solicita',
        'observaciones'
    ];
}
