@extends('app')

@section('conteudo')
<div class="header">
    <h4>Adicionar tipo de refrigerante</h4>
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
        Tipo
    </div>

    <div class="card-body">
        <form class="" action="{{url('/tipos-refrigerantes/adicionar')}}" method="post">
            {{ csrf_field() }}

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for=""><strong>* Tipo<strong></label>
                        <input type="text" class="form-control" name="tipo" value="{{old('tipo')}}" >
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Descrição</label>
                        <textarea name="descricao"  class="form-control" rows="8">{{old('descricao')}}</textarea>
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
