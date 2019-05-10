@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')
    <form role="form" method="post" action="{{Request::root()}}/Categorias/add-Categorias-post" >
    <div class="box box-solid box-primary">

        <div class="box-header">
            <h2>Adicionar Categoria</h2>
        </div>
        <div class="box-body">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome">
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </div>
    </form>
@endsection
