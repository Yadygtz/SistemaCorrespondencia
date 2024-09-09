<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumerosAreas extends Model
{
    use HasFactory;

    protected $table = 'numerosareas';

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
