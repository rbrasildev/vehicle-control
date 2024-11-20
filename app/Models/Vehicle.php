<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = "veiculos";

    use HasFactory;

    protected $fillable = [
        'placa',
        'marca',
        'modelo',
        'ano',
        'chassi'
    ];
}
