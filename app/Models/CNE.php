<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CNE extends Model
{
    use HasFactory;
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql2';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_cne_a_union_web';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'numero_identidad';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
    */
   protected $appends = ['nombre_completo'];

    /**
     * Atributo obtener nombre completo
     */
    public function getNombreCompletoAttribute()
    {
        return $this->primer_nombre . ' ' . $this->segundo_nombre . ' ' . $this->primer_apellido . ' ' . $this->segundo_apellido;
    }
}
