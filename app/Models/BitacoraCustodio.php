<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BitacoraCustodio extends Model
{
    use HasFactory;
    protected $table = 'tbl_bitacora_custodios';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_bitacora';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'fecha_hora_bitacora',
        'dni_usuario_accion',
        'dni_custodio',
        'accion',
        'descripcion',
    ];
}
