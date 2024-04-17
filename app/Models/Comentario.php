<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comentario
 *
 * @property $id
 * @property $Id_Actividad
 * @property $Id_User
 * @property $Comentario
 * @property $Documento_path
 * @property $created_at
 * @property $updated_at
 *
 * @property Actividadembarque $actividadembarque
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Comentario extends Model
{

    static $rules = [
        'Id_Actividad' => 'required',
        'Id_User' => 'required',
        'Comentario' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Id_Actividad', 'Id_User', 'Comentario', 'Documento_path', 'FComentario'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function actividadembarque()
    {
        return $this->hasOne('App\Models\Actividadembarque', 'id', 'Id_Actividad');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'Id_User');
    }
}
