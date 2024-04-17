<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Anticipo
 *
 * @property $id
 * @property $Id_Embarque
 * @property $cantidad
 * @property $Fecha_Anticipo
 * @property $created_at
 * @property $updated_at
 *
 * @property Embarque $embarque
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Anticipo extends Model
{

  static $rules = [
    'Id_Embarque' => 'required',
    'cantidad' => 'required',
    'Fecha_Anticipo' => 'required',
  ];

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['Id_Embarque', 'cantidad', 'Fecha_Anticipo'];


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function embarque()
  {
    return $this->hasOne('App\Models\Embarque', 'id', 'Id_Embarque');
  }
}
