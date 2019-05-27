<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{
    protected $table = "tb_marca_refrigerante";
    protected $fillable = ['nome', 'descricao'];
}
