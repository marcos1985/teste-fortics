<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Litragem extends Model
{
    protected $table = "tb_litragem_refrigerante";
    protected $fillable = ['nome', 'descricao'];
}
