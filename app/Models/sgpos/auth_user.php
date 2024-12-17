<?php

namespace App\Models\Sgpos;

use Illuminate\Database\Eloquent\Model;

class auth_user extends Model
{
    protected $connection = 'sgp';
    protected $table = 'auth_user';
}
