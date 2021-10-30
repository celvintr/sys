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
    protected $primaryKey = 'idc_custodio';

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
        'cod_departamento',
        'cod_municipio',
        'dir_custodio',
        'cod_partido',
        'cod_centro',
        'cod_estado',
        'cod_tipo_custodio',
        'fecha_registro',
        'dni_usuario_registro',
        'hoja_incidencia',
        'fecha_nacimiento',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
    */
   protected $appends = ['avatar', 'foto', 'foto_dni', 'foto_comp'];

   protected $casts = [
    'fecha_nacimiento' => 'datetime',
];

    /**
     * Obtener avatar
     */
    public function getAvatarAttribute()
    {
        if (empty($this->foto_custodio)) {
            return "https://ui-avatars.com/api/?name=" . $this->nombre_custodio . "&color=7F9CF5&background=EBF4FF";
        } else {
            return asset('storage/' . $this->foto_custodio);
        }
    }

    /**
     * Obtener avatar
     */
    public function getFotoAttribute()
    {
        return asset('storage/' . $this->foto_custodio);
    }

    /**
     * Obtener avatar
     */
    public function getFotoDniAttribute()
    {
        return asset('storage/' . $this->foto_dni_custodio);
    }

    /**
     * Obtener avatar
     */
    public function getFotoCompAttribute()
    {
        return asset('storage/' . $this->foto_comp_custodio);
    }

    /**
     * Relacion estado, devuelve la instancia de estado y asi acceder a sus propiedades
     */

    public function estado()
    {
        return $this->belongsTo(EstadoCustodio::class, 'cod_estado', 'cod_estado');
    }

    /**
     * Relacion partido, devuelve la instancia de partido y asi acceder a sus propiedades
     */

    public function partido()
    {
        return $this->belongsTo(PartidosPoliticos::class, 'cod_partido', 'cod_partido');
    }

    /**
     * Relacion municipio, devuelve la instancia de municipio y asi acceder a sus propiedades
     */

    public function departamento()
    {
        return $this->belongsTo(Departamentos::class, 'cod_departamento', 'cod_departamento');
    }

    /**
     * Relacion municipio, devuelve la instancia de municipio y asi acceder a sus propiedades
     */

    public function municipio()
    {
        return $this->belongsTo(Municipios::class, 'cod_municipio', 'cod_municipio');
    }

     /**
     * Relacion centro de votacion, devuelve la instancia de centro de votacion y asi acceder a sus propiedades
     */
    public function centro()
    {
        return $this->belongsTo(CentrosVotacion::class, 'cod_centro', 'cod_centro');
    }

    /**
     * Relacion tipo de custodio, devuelve la instancia de tipo de custodio y asi acceder a sus propiedades
     */
    public function tipoCustodio()
    {
        return $this->belongsTo(TipoCustodio::class, 'cod_tipo_custodio', 'cod_tipo_custodio');
    }
}
