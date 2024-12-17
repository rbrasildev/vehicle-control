<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OilChange extends Model
{
    protected $table = 'trocas_de_oleo';

    protected $fillable = [
        'id_veiculo',
        'tipo_de_oleo_id',
        'data_troca',
        'quilometragem',
        'valor',
        'observacoes'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'id_veiculo');
    }

    public function typeOfOil()
    {
        return $this->belongsTo(TypeOfOil::class, 'tipo_de_oleo_id');
    }
}
