<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentrosVotacion extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_centros_votacion';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'cod_centro';

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
        'cod_centro',
        'nombre_centro',
        'cod_municipio',
    ];

    /**
     * Municipios.
     */
    public function municipio()
    {
        return $this->belongsTo(Municipios::class, 'cod_municipio', 'cod_municipio');
    }
}
