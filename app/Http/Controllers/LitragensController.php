<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Session;

use App\Models\Litragem;
use App\Http\Requests\AdicionarLitragemRequest;
use App\Http\Requests\AtualizarLitragemRequest;

class LitragensController extends Controller
{
    public function index(Request $request) {

        $viewData = [];
        $queryPagination = [];

        $dados = $request->all();

        $query = Litragem::query();

        $viewData['nome'] = "";

        if (!empty($dados['nome'])) {
            $query->where('nome', 'like', '%' . $dados['nome'] . '%');
            $viewData['nome'] = $dados['nome'];
            $queryPagination['nome'] = $dados['nome'];
        }

        $litragens = $query->paginate(5);

        $viewData['litragens'] = $litragens;
        $viewData['queryPagination'] = $queryPagination;

        return view('litragens.list', $viewData);
    }

    public function create(Request $request) {

        return view('litragens.create');

    }

    public function strore(AdicionarLitragemRequest $request) {

        $dados = $request->all();

        $litragem = new Litragem();
        $litragem->nome = $dados['nome'];

        if (!empty($dados['descricao'])) {
            $litragem->descricao = $dados['descricao'];
        }

        if ($litragem->save()){
            Session::flash("mensagem", "Litragem adicionada com sucesso!");
            return redirect("litragens");
        }
    }

    public function edit($id, Request $request) {

        $litragem = Litragem::find($id);

        $viewData = [];
        $viewData['litragem'] = $litragem;

        return view('litragens.edit', $viewData);

    }

    public function update(AtualizarLitragemRequest $request) {

        $dados = $request->all();

        $litragem = Litragem::find($dados['id']);

        $litragem->nome = $dados['nome'];
        $litragem->descricao = $dados['descricao'];

        if ($litragem->save()) {
            Session::flash("mensagem", "Litragem atualizada com sucesso!");
            return redirect("litragens");
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
                $litragem = Litragem::find($selecionado);
                $litragem->delete();
            }

            DB::commit();
        } catch(Exception $e) {
            DB::rollbBck();
            $resposta['status'] = false;
        }

        return response()->json($resposta);
    }

}
