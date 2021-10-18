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

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
    */
   protected $appends = ['avatar'];

    /**
     * Obtener avatar
     */
    public function getAvatarAttribute()
    {
        if (empty($this->foto_custodio)) {
            return "https://ui-avatars.com/api/?name=" . $this->nombre_custodio . "&color=7F9CF5&background=EBF4FF";
        } else {
            return asset('storage/custodios/' . $this->foto_custodio);
        }
    }

    /**
     * Obtener avatar
     */
    public function getFotoAttribute()
    {
        return asset('storage/custodios/' . $this->foto_custodio);
    }

    /**
     * Obtener avatar
     */
    public function getFotoDniAttribute()
    {
        return asset('storage/custodios/' . $this->foto_dni_custodio);
    }

    /**
     * Obtener avatar
     */
    public function getFotoCompAttribute()
    {
        return asset('storage/custodios/' . $this->foto_comp_custodio);
    }
}
