<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EncuestaModel extends Model
{
    protected $table = 'encuestas';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'genero', 'hobby', 'dedicacion'
    ];
}
