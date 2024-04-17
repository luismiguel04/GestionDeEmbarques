<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Servicio
 *
 * @property $id
 * @property $Nombre
 * @property $created_at
 * @property $updated_at
 *
 * @property ActividadesFija[] $actividadesFijas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Servicio extends Model
{
    
    static $rules = [
		'Nombre' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Nombre'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function actividadesFijas()
    {
        return $this->hasMany('App\Models\ActividadesFija', 'servicios_id', 'id');
    }
    

}
