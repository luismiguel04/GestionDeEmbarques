<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Contacto
 *
 * @property $id
 * @property $Nombre
 * @property $Puesto
 * @property $Correo
 * @property $Empresa
 * @property $created_at
 * @property $updated_at
 *
 * @property Cliente $cliente
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Contacto extends Model
{

  static $rules = [
    'Nombre' => 'required',
    'Puesto' => 'required',
    'Correo' => 'required',
    'Telefono' => 'required',


  ];

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['Nombre', 'Puesto', 'Correo', 'Telefono', 'Empresa'];


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function cliente()
  {
    return $this->hasOne('App\Models\Cliente', 'id', 'Empresa');
  }
}
