@extends('app')

@section('conteudo')
<div class="header">
    <h4>Atualizar litragem</h4>
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
        Litragem
    </div>

    <div class="card-body">
        <form class="" action="{{url('/litragens/atualizar')}}" method="post">
            {{ csrf_field() }}

            <input type="hidden" name="id" value="{{$litragem->id}}">

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for=""><strong>* Nome<strong></label>
                        <input type="text" class="form-control" name="nome" value="{{$litragem->nome}}" >
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Descrição</label>
                        <textarea name="descricao"  class="form-control" rows="8">{{$litragem->descricao}}</textarea>
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
