<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ActividadesFija
 *
 * @property $id
 * @property $Nombre
 * @property $Fecha_estimada
 * @property $servicios_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Servicio $servicio
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ActividadesFija extends Model
{

  static $rules = [
    'Nombre' => 'required',
    'Fecha_estimada' => 'required',
    'servicios_id' => 'required',
  ];

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['Nombre', 'Fecha_estimada', 'servicios_id'];


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function servicio()
  {
    return $this->hasOne('App\Models\Servicio', 'id', 'servicios_id');
  }
}
