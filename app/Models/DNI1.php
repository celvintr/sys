<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DNI extends Model
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
}
