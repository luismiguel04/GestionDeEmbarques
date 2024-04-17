<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Embarque
 *
 * @property $id
 * @property $Referencia
 * @property $Empresa
 * @property $Encargado
 * @property $ETA
 * @property $Status
 * @property $created_at
 * @property $updated_at
 *
 * @property Cliente $cliente
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Embarque extends Model
{

    static $rules = [
        'Referencia' => 'required',
        'Empresa' => 'required',
        'Encargado' => 'required',
        'ETA' => 'required',
        'Status' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Referencia', 'Empresa', 'Encargado', 'ETA', 'Status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente()
    {
        return $this->hasOne('App\Models\Cliente', 'id', 'Empresa');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'Encargado');
    }
    public function anticipos()
    {
        return $this->hasMany('App\Models\Anticipo', 'id', 'Anticipo');
    }
}
