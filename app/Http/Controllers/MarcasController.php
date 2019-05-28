<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Session;

use App\Models\Marca;
use App\Http\Requests\AdicionarMarcaRequest;
use App\Http\Requests\AtualizarMarcaRequest;

class MarcasController extends Controller
{
    public function index(Request $request) {

        $viewData = [];
        $queryPagination = [];

        $dados = $request->all();

        $query = Marca::query();

        $viewData['nome'] = "";

        if (!empty($dados['nome'])) {
            $query->where('nome', 'like', '%' . $dados['nome'] . '%');
            $viewData['nome'] = $dados['nome'];
            $queryPagination['nome'] = $dados['nome'];
        }

        $marcas = $query->paginate(5);

        $viewData['marcas'] = $marcas;
        $viewData['queryPagination'] = $queryPagination;

        return view('marcas.list', $viewData);
    }

    public function create(Request $request) {

        return view('marcas.create');

    }

    public function strore(AdicionarMarcaRequest $request) {

        $dados = $request->all();

        $marca = new Marca();
        $marca->nome = $dados['nome'];

        if (!empty($dados['descricao'])) {
            $marca->descricao = $dados['descricao'];
        }

        if ($marca->save()){
            Session::flash("mensagem", "Marca adicionada com sucesso!");
            return redirect("marcas");
        }
    }

    public function edit($id, Request $request) {

        $marca = Marca::find($id);

        $viewData = [];
        $viewData['marca'] = $marca;

        return view('marcas.edit', $viewData);

    }

    public function update(AtualizarMarcaRequest $request) {

        $dados = $request->all();

        $marca = Marca::find($dados['id_marca']);

        $marca->nome = $dados['nome'];
        $marca->descricao = $dados['descricao'];

        if ($marca->save()) {
            Session::flash("mensagem", "Marca atualizada com sucesso!");
            return redirect("marcas");
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
                $marca = Marca::find($selecionado);
                $marca->delete();
            }

            DB::commit();
        } catch(Exception $e) {
            DB::rollbBck();
            $resposta['status'] = false;
        }

        return response()->json($resposta);
    }

}
