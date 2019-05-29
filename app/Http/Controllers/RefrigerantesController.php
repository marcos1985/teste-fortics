<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Refrigerante;
use App\Models\Marca;
use App\Models\TipoRefrigerante;
use App\Models\Litragem;

use Session;

class RefrigerantesController extends Controller
{
    public function index(Request $request) {

        $viewData = [];
        $queryPagination = [];

        $dados = $request->all();

        $tipos   = TipoRefrigerante::all();
        $litragens = Litragem::all();

        $query = Refrigerante::query();

        $viewData['nome'] = "";

        if (!empty($dados['nome'])) {
            $query->where('nome', 'like', '%' . $dados['nome'] . '%');
            $viewData['nome'] = $dados['nome'];
            $queryPagination['nome'] = $dados['nome'];
        }

        // if (!empty($dados['nome'])) {
        //     $query->where('nome', 'like', '%' . $dados['nome'] . '%');
        //     $viewData['nome'] = $dados['nome'];
        //     $queryPagination['nome'] = $dados['nome'];
        // }

        $refrigerantes = $query->paginate(5);

        #dd($refrigerantes);

        $viewData['refrigerantes'] = $refrigerantes;
        $viewData['tipos']  = $tipos;
        $viewData['litragens'] = $litragens;

        $viewData['queryPagination'] = $queryPagination;

        return view('refrigerantes.list', $viewData);
    }

    public function create(Request $request) {

        $tipos   = TipoRefrigerante::all();
        $litragens = Litragem::all();
        
        $viewData['tipos']  = $tipos;
        $viewData['litragens'] = $litragens;

        return view('refrigerantes.create', $viewData);

    }

    public function strore(Request $request) {
        $dados = $request->all();

        #dd($dados);

        $refrigerante = new Refrigerante();

        $refrigerante->nome = $dados['nome'];
        $refrigerante->sabor = $dados['sabor'];
        $refrigerante->id_tipo_refrigerante = $dados['id_tipo_refrigerante'];
        $refrigerante->id_litragem = $dados['id_litragem'];
        $refrigerante->qtd_estoque = is_numeric($dados['qtd_estoque']) ? $dados['qtd_estoque'] : 0;
        $refrigerante->valor_unidade = str_replace(',', '.', str_replace('.', '', $dados['valor_unidade']));

        if ($refrigerante->save()) {
            Session::flash("mensagem", "Refrigerante adicionado com sucesso!");
            return redirect("refrigerantes");
        }

    }

    public function ajaxDelete(Request $request) {

        $dados = $request->all();
        //dd($dados);
        $resposta = [];

        $resposta['status'] = true;

        DB::beginTransaction();

        try {

            foreach( $dados['seleciondados'] as $selecionado ) {
                $refrigerante = Refrigerante::find($selecionado);
                $refrigerante->delete();
            }

            DB::commit();
        } catch(Exception $e) {
            DB::rollbBck();
            $resposta['status'] = false;
        }

        return response()->json($resposta);
    }

}
