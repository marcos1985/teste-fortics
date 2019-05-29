@extends('app')

@section('conteudo')
<div class="header">
    <h4>Adicionar referigerante</h4>
    <hr>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>

    </div>
@endif


<div class="card">
    <div class="card-header">
        Refrigerante
    </div>

    <div class="card-body">
        <form class="" action="{{url('/refrigerantes/adicionar')}}" method="post">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">* Nome</label>
                        <input type="text" class="form-control" name="nome" value="{{old('nome')}}">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">* Sabor</label>
                        <input type="text" class="form-control" name="sabor" value="{{old('sabor')}}">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">* Tipo</label>
                        <select class="form-control" value="{{old('id_tipo_refrigerante')}}" name="id_tipo_refrigerante">
                            <option value="">Selecione ...</option>
                            @foreach($tipos as $tipo)
                            <option value="{{$tipo->id}}">{{$tipo->tipo}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">* Litragem</label>
                        <select class="form-control" value='{{old('id_litragem')}}' name="id_litragem">
                            <option value="">Selecione ...</option>
                            @foreach($litragens as $litragem)
                            <option value="{{$litragem->id}}">{{$litragem->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-1">
                    <div class="form-group">
                        <label for="">* Quantidade</label>
                        <input type="text" class="form-control" name="qtd_estoque" value="{{old('qtd_estoque')}}" style="text-align:right;" >
                    </div>
                </div>

                <div class="col-md-1">
                    <div class="form-group">
                        <label for="">* Valor (R$)</label>
                        <input type="text" class="form-control money" name="valor_unidade" value="{{old('valor_unidade')}}" style="text-align:right;">
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary" name="">Salvar</button>
                </div>
            </div>

        </form>
    </div>

</div>

@endsection

@section('scripts')

<script type="text/javascript">

    $(function(){
        $('.money').mask('000.000.000.000.000,00', {reverse: true});
    });



</script>

@endsection
