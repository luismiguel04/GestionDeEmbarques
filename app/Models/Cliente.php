<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cliente
 *
 * @property $id
 * @property $Nombre
 * @property $Direccion
 * @property $created_at
 * @property $updated_at
 *
 * @property Contacto[] $contactos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cliente extends Model
{

  static $rules = [
    'Nombre' => 'required',
    'Direccion' => 'required',
  ];

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['Nombre', 'Direccion'];


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function contactos()
  {
    return $this->hasMany('App\Models\Contacto', 'Empresa', 'id');
  }
}
