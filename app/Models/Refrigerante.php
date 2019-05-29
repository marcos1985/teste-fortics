<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
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

    public static function verificaUnicidade ($dados) {

        $query = self::query();

        $query->where('nome', $dados['nome']);
        #$query->where('sabor', $dados['sabor']);
        $query->where('id_tipo_refrigerante', $dados['id_tipo_refrigerante']);
        $query->where('id_litragem', $dados['id_litragem']);

        if (!empty($dados['id'])) {
            $query->where('id', '!=', $dados['id']);
        }

        $refrigerantes = $query->get();

        #dd($refrigerantes);

        if ( count($refrigerantes) > 0 ) {
            return false;
        }

        return true;

    }

}
