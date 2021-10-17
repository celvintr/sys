<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custodios extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_custodios';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'cod_custodio';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'cod_custodio',
        'dni_custodio',
        'nombre_custodio',
        'tel_movil',
        'tel_fijo',
        'correo1_custodio',
        'correo2_custodio',
        'foto_custodio',
        'foto_dni_custodio',
        'foto_comp_custodio',
        'cod_municipio',
        'dir_custodio',
        'cod_partido',
        'cod_centro',
        'estado_custodio',
        'fecha_registro',
        'cod_usuario_registro',
    ];
}
