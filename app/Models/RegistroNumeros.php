<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroNumeros extends Model
{
    use HasFactory;
   

    protected $fillable = [
        'numeroId',
        'fecha',
        'area',
        'asunto',
        'solicita',
        'observaciones'
    ];

}
