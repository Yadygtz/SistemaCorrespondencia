<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumerosAreasAnt extends Model
{
    use HasFactory;

    protected $table = 'numerosareas_2025';

    protected $fillable = [
        'numeroId',
        'fecha',
        'area',
        'asunto',
        'solicita',
        'observaciones',
        'id_area'
    ];
}
