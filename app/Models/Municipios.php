<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipios extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_municipios';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'cod_municipio';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

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
        'cod_municipio',
        'nombre_municipio',
        'cod_departamento',
    ];

    /**
     * Departamento.
     */
    public function departamento()
    {
        return $this->belongsTo(Departamentos::class, 'cod_departamento', 'cod_departamento');
    }

    /**
     * Centros de votacion.
     */
    public function centros()
    {
        return $this->hasMany(CentrosVotacion::class, 'cod_municipio', 'cod_municipio');
    }
}
