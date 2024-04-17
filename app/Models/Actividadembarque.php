<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Actividadembarque
 *
 * @property $id
 * @property $Id_Embarque
 * @property $Id_Actividad
 * @property $Id_User
 * @property $A_Status
 * @property $created_at
 * @property $updated_at
 *
 * @property ActividadesFija $actividadesFija
 * @property Embarque $embarque
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Actividadembarque extends Model
{

    static $rules = [
        'Id_Embarque' => 'required',
        /*  'Id_Actividad' => 'required', */
        /*   'Id_User' => 'required', */
        'A_Status' => 'required',
    ];
    protected $casts = [
        'Id_Actividad' => 'array',
        'Id_User' => 'array'
    ];
    protected $attributes = [
        'Id_Actividad' => '[]',
        'Id_User' => '[]'
    ];


    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Id_Embarque', 'Id_Actividad', 'Id_User', 'A_Status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function actividadesFija()
    {
        return $this->hasOne('App\Models\ActividadesFija', 'id', 'Id_Actividad');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function embarque()
    {
        return $this->hasOne('App\Models\Embarque', 'id', 'Id_Embarque');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'Id_User');
    }
}
