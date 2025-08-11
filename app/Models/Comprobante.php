<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    //
    protected $fillable = [
        'clave',
        'consecutivo',
        'estado',
        'cedula',
        'nombre',
        'url_carpeta',
        'url_firmado',
        'url_respuesta',
        'url_pdf'
    ];
    
}
