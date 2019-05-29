<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Marca;
use App\Models\TipoRefrigerante;
use App\Models\Litragem;

class Refrigerante extends Model
{
    protected $table = "tb_refrigerante";
    protected $fillable = ['nome', 'id_marca', 'id_tipo_refrigerante', 'id_litragem', 'qtd_estoque', 'valor_unidade'];

    public function marca() {
        return $this->hasOne(Marca::class, 'id', 'id_marca');
    }

    public function tipo() {
        return $this->hasOne(TipoRefrigerante::class, 'id','id_tipo_refrigerante');
    }

    public function litragem() {
        return $this->hasOne(Litragem::class, 'id','id_litragem');
    }

}
