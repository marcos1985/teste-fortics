<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TipoRefrigerante;
use App\Http\Requests\AdicionarTipoRequest;
use App\Http\Requests\AtualizarTipoRequest;

use Illuminate\Support\Facades\DB;

use Session;

class TiposRefrigeranteController extends Controller
{
    public function index(Request $request) {

        $viewData = [];
        $queryPagination = [];

        $dados = $request->all();

        $query = TipoRefrigerante::query();

        $viewData['tipo'] = "";

        if (!empty($dados['tipo'])) {
            $query->where('tipo', 'like', '%' . $dados['tipo'] . '%');
            $viewData['tipo'] = $dados['tipo'];
            $queryPagination['tipo'] = $dados['tipo'];
        }

        $tipos = $query->paginate(5);

        $viewData['tipos'] = $tipos;
        $viewData['queryPagination'] = $queryPagination;

        return view('tipos.list', $viewData);

    }

    public function create(Request $request) {

        return view('tipos.create');

    }

    public function strore(AdicionarTipoRequest $request) {

        $dados = $request->all();

        $tipo = new TipoRefrigerante();
        $tipo->tipo = $dados['tipo'];

        if (!empty($dados['descricao'])) {
            $tipo->descricao = $dados['descricao'];
        }

        if ($tipo->save()){
            Session::flash("mensagem", "Tipo de refrigerante adicionada com sucesso!");
            return redirect("/tipos-refrigerantes");
        }
    }

    public function edit($id, Request $request) {

        $tipo = TipoRefrigerante::find($id);

        $viewData = [];
        $viewData['tipo'] = $tipo;

        return view('tipos.edit', $viewData);

    }

    public function update(AtualizarTipoRequest $request) {

        $dados = $request->all();

        $tipo = TipoRefrigerante::find($dados['id']);

        $tipo->tipo = $dados['tipo'];
        $tipo->descricao = $dados['descricao'];

        if ($tipo->save()) {
            Session::flash("mensagem", "Tipo atualizado com sucesso!");
            return redirect("/tipos-refrigerantes");
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
                $tipo = TipoRefrigerante::find($selecionado);
                $tipo->delete();
            }

            DB::commit();
        } catch(Exception $e) {
            DB::rollbBck();
            $resposta['status'] = false;
        }

        return response()->json($resposta);
    }

}
