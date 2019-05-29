@extends('app')

@section('conteudo')

    {{csrf_field()}}

    <div class="header">
        <h4>Refrigerantes</h4>
        <hr>
    </div>

    @if (Session::has('mensagem'))
    <div class="alert alert-success">
        {{Session::get('mensagem')}}
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            Filros
        </div>

        <div class="card-body">

            <form id="form-busca" class="" action="" method="get">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Nome</label>
                            <input type="text" class="form-control" name="nome" value="{{$nome}}">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Marca</label>
                            <select class="form-control" name="id_marca">
                                <option value="">Selecione ...</option>
                                @foreach($marcas as $marca)
                                <option value="{{$marca->id}}">{{$marca->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Tipo</label>
                            <select class="form-control" name="id_tipo_refrigerante">
                                <option value="">Selecione ...</option>
                                @foreach($tipos as $tipo)
                                <option value="{{$tipo->id}}">{{$tipo->tipo}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Litragem</label>
                            <select class="form-control" name="id_litragem">
                                <option value="">Selecione ...</option>
                                @foreach($litragens as $litragem)
                                <option value="{{$litragem->id}}">{{$litragem->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" name="">Buscar</button>
                    </div>
                </div>

            </form>

        </div>

    </div>

    <div class="vspace" ></div>

    <div class="card" id="card-refri">
        <div class="card-header">
            Marcas
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-md-4" >
                    <a href="{{url('/refrigerantes/novo')}}"class="btn btn-primary">Novo</a>
                </div>

                <div class="col-md-4" >
                    <button type="button"  id="btn-excluir-refri" class="btn btn-danger" name="">Excluir</button>
                </div>

            </div>

            <div class="vspace" ></div>

            <div class="row">

                <div class="col-md-12">
                    <table class="table table-striped" >
                        <thead>
                            <tr>
                                <th> <input type="checkbox" id="ch-tudo-refri" name="" value=""> </th>
                                <th>#ID</th>
                                <th>Nome</th>
                                <th>Marca</th>
                                <th>Tipo</th>
                                <th>Litragem</th>
                                <th>Qtd</th>
                                <th>Valor Unidade</th>
                                <th>Data Cadastro</th>
                                <th>Data Atualização</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($refrigerantes as $refrigerante)
                                <tr>

                                    <td> <input type="checkbox" class="ch-refri" name="" value="{{$refrigerante->id}}"> </td>
                                    <td>{{$refrigerante->id}}</td>
                                    <td>{{$refrigerante->nome}}</td>
                                    <td>{{$refrigerante->marca()->first()->nome}}</td>
                                    <td>{{$refrigerante->tipo()->first()->tipo}}</td>
                                    <td>{{$refrigerante->litragem()->first()->nome}}</td>
                                    <td>{{$refrigerante->qtd_estoque}}</td>
                                    <td>R$ {{number_format($refrigerante->valor_unidade,2,',', '.')}}</td>
                                    <td>
                                        @if (!empty($refrigerante->created_at))
                                            {{date('d/m/Y', strtotime($refrigerante->created_at))}}
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($refrigerante->updated_at))
                                            {{date('d/m/Y', strtotime($refrigerante->updated_at))}}
                                        @endif
                                    </td>
                                    <td> <a href="{{url('/refrigerantes/' . $refrigerante->id . '/editar/')}}">Editar</a> </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                    {{$refrigerantes->appends($queryPagination)->links()}}

                </div>

            </div>

        </div>
    </div>

@endsection


@section('scripts')

<script>
    $(function(){
        RefriController.init();
    });


    var RefriController = {
        init: function() {

            var self = this;

            $("#ch-tudo-refri").on('click', function(){
                self.selecionarTudo();
            });

            $("#btn-excluir-refri").on('click', function(){
                self.excluirSelecionados();
            });

        },

        selecionarTudo: function() {
            var selecionado = $("#ch-tudo-refri").prop('checked');
            $(".ch-refri").prop('checked', selecionado);
        },

        excluirSelecionados: function() {

            var self = this;

            var selecionados = self.auxPsegarSelecionados();

            if ( !selecionados.length ) {
                swal("Alerta", "Nenhum item selecionado!", 'warning');
                return false;
            }

            swal({
              title: "Alerta",
              text: "Você tem certeza que deseja excluir os itens selecionados?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then( function (willDelete) {
              if (willDelete) {

                  $('#card-refri').loading({
                      theme: 'dark',
                      message: 'Realizando exclusão, aguarde ...'
                  });

                  self.auxAjaxExcluirMarcas(selecionados);

              }
            });

        },

        auxPsegarSelecionados: function() {
            var ids = [];
            var selecionados = $(".ch-refri:checked");

            selecionados.each(function(index,item){
                ids.push($(item).val());
            });

            return ids;
        },

        auxAjaxExcluirMarcas: function (selecionados) {

            var ajaxExclusao = $.ajax({
                url: "{{url('/refrigerantes/ajax/excluir')}}",
                type: 'post',
                dataType: 'json',
                data: {
                    _token: $("input[name='_token']").val(),
                    seleciondados: selecionados
                }
            });

            ajaxExclusao.done(function(resultado){
                $('#card-refri').loading('stop');

                if (resultado.status) {
                    swal('', "Exclusão realizada com sucesso!", 'success').then(function () {
                        $("#form-busca").submit();
                    });
                }

                if (!resultado.status) {
                    swal("Erro", "Erro ao realizar exclusão!", "error");
                }

            });

            ajaxExclusao.fail(function(){
                $('#card-refri').loading('stop');
                swal("Erro", "Erro ao realizar exclusão!", "error");

            });

        }

    }
</script>

@endsection
