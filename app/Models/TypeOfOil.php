<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfOil extends Model
{
    use HasFactory;

    protected $table = 'tipos_de_oleo';

    protected $fillable = ['nome', 'viscosidade', 'fabricante'];

    public function oiChange()
    {
        return $this->hasMany(OilChange::class, 'tipo_de_oleo_id');
    }
}
