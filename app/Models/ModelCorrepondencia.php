<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelCorrepondencia extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_correspondencia';

    protected $fillable = [
        'no_oficio',
        'fecha_oficio',
        'enviado_por',
        'asunto',
        'area',
        'folder',
        'recibido_por',
        'fecha_recibido',
        'se_contesta',
        'fecha_contestado',
        'contestado_con',
        'creado_por',
        'fecha_creado',
        'modificado_por',
        'fecha_modificado'
    ];
}
