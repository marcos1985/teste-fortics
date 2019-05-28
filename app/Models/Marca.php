<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marca extends Model
{
    protected $table = "tb_marca_refrigerante";
    protected $fillable = ['nome', 'descricao'];
}
