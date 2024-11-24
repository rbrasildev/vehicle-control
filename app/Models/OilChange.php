<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OilChange extends Model
{
    protected $table = 'trocas_de_oleo';

    protected $fillable = [
        'id_veiculo',
        'data_troca',
        'quilometragem',
        'tipo_oleo',
        'valor',
        'observacoes'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'id_veiculo');
    }
}
