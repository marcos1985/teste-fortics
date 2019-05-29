@extends('app')

@section('conteudo')

    {{csrf_field()}}

    <div class="header">
        <h4>Tipos de refrigerantes</h4>
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
                            <input type="text" class="form-control" name="tipo" value="{{$tipo}}">
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

    <div class="card" id="card-tipos">
        <div class="card-header">
            Tipos de refrigerantes
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-md-4" >
                    <a href="{{url('/tipos-refrigerantes/novo')}}"class="btn btn-primary">Novo</a>
                </div>

                <div class="col-md-4" >
                    <button type="button"  id="btn-excluir-tipo" class="btn btn-danger" name="">Excluir</button>
                </div>

            </div>

            <div class="vspace" ></div>

            <div class="row">

                <div class="col-md-12">
                    <table class="table table-striped" >
                        <thead>
                            <tr>
                                <th> <input type="checkbox" id="ch-tudo-tipo" name="" value=""> </th>
                                <th>#ID</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Data Cadastro</th>
                                <th>Data Atualização</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($tipos as $tipo)
                                <tr>
                                    <td> <input type="checkbox" class="ch-tipo" name="" value="{{$tipo->id}}"> </td>
                                    <td>{{$tipo->id}}</td>
                                    <td>{{$tipo->tipo}}</td>
                                    <td>{{$tipo->descricao}}</td>
                                    <td>
                                        @if (!empty($tipo->created_at))
                                            {{date('d/m/Y H:i', strtotime($tipo->created_at))}}
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($tipo->updated_at))
                                            {{date('d/m/Y H:i', strtotime($tipo->updated_at))}}
                                        @endif
                                    </td>
                                    <td> <a href="{{url('/tipos-refrigerantes/' . $tipo->id . '/editar/')}}">Editar</a> </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                    {{$tipos->appends($queryPagination)->links()}}

                </div>

            </div>

        </div>
    </div>

@endsection


@section('scripts')

<script>
    $(function(){
        TiposRefrigerantesController.init();
    });


    var TiposRefrigerantesController = {
        init: function() {

            var self = this;

            $("#ch-tudo-tipo").on('click', function(){
                self.selecionarTudo();
            });

            $("#btn-excluir-tipo").on('click', function(){
                self.excluirSelecionados();
            });

        },

        selecionarTudo: function() {
            var selecionado = $("#ch-tudo-tipo").prop('checked');
            $(".ch-tipo").prop('checked', selecionado);
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

                  $('#card-tipos').loading({
                      theme: 'dark',
                      message: 'Realizando exclusão, aguarde ...'
                  });

                  self.auxAjaxExcluirMarcas(selecionados);

              }
            });

        },

        auxPsegarSelecionados: function() {
            var ids = [];
            var selecionados = $(".ch-tipo:checked");

            selecionados.each(function(index,item){
                ids.push($(item).val());
            });

            return ids;
        },

        auxAjaxExcluirMarcas: function (selecionados) {

            var ajaxExclusao = $.ajax({
                url: "{{url('/tipos-refrigerantes/ajax/excluir')}}",
                type: 'post',
                dataType: 'json',
                data: {
                    _token: $("input[name='_token']").val(),
                    seleciondados: selecionados
                }
            });

            ajaxExclusao.done(function(resultado){
                $('#card-tipos').loading('stop');

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
                $('#card-tipos').loading('stop');
                swal("Erro", "Erro ao realizar exclusão!", "error");

            });

        }

    }
</script>

@endsection
