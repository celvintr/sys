<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_usuarios';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'dni_usuario';

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
        'dni_usuario',
        'nombre_usuario',
        'pass_usuario',
        'cargo_usuario',
        'cod_rol',
        'tel_usuario',
        'correo_usuario',
        'cod_departamento',
        'cod_municipio',
        'dir_usuario',
        'estado_usuario',
        'fecha_registro',
        'cod_usuario_registro',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'pass_usuario',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'fecha_registro' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->pass_usuario;
    }

    public function getAvatarAttribute()
    {
        if (empty($this->foto_usuario)) {
            return "https://ui-avatars.com/api/?name=" . $this->nombre_usuario . "&color=7F9CF5&background=EBF4FF";
        } else {
            return asset('storage/usuarios/' . $this->foto_usuario);
        }
    }
}
