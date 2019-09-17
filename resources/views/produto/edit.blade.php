@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')

    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/jquery.mask.js')}}"></script>
    <script src="{{asset('js/jquery.autocomplete.js')}}"></script>
    <script src="{{asset('js/util.js')}}"></script>
    <link href="{{asset('css/jquery.autocomplete.css')}}" rel="stylesheet"/>

    <div class="box">
        <div class="box-header">
            <h2>Update Produto</h2>
        </div>
        <form role="form" method="post" action="/produto/edit" enctype="multipart/form-data">
        <div class="box-body">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" value="<?php echo $Produto->id ?>"   name="Produto_id">
                <div class="form-group">
                    <label for="descricao">Descricao:</label>
                    <input type="text" value="<?php echo $Produto->descricao ?>" class="form-control" id="descricao" name="descricao">
                </div>

                <div class="form-group">
                    <label for="quantidade">Quantidade:</label>
                    <input type="number" value="<?php echo $Produto->quantidade ?>" class="form-control" id="quantidade" name="quantidade">
                </div>
                <div class="form-group">
                    <label for="valor">Valor:</label>
                    <input type="text" value="{{$Produto->valor}}" class="form-control money" id="valor" name="valor">
                </div>
                <div class="form-group">
                    <label for="categoria">Categoria:</label>
                    <select class="form-control" id="categoria" name="categoria">
                        @foreach($Categorias as $categoria)
                            <option @if($categoria->id == $Produto->categoria_id) selected="selected" @endif value="{{$categoria->id}}">{{$categoria->nome}}</option>
                        @endforeach
                    </select>
                </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>

    </div>




@endsection