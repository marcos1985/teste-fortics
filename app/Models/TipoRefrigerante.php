<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoRefrigerante extends Model
{
    protected $table = "tb_tipo_refrigerante";
    protected $fillable = ['tipo', 'descricao'];
}
