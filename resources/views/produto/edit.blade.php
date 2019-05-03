@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')

<h2>Update Produto</h2>
<form role="form" method="post" action="{{Request::root()}}/Produto/edit-Produto-post" enctype="multipart/form-data">
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
        <input type="number" value="<?php echo $Produto->valor ?>" class="form-control" id="valor" name="valor">
    </div>
    <div class="form-group">
        <label for="Categoria">Categoria:</label>
        <select class="form-control" id="Categoria" name="Categoria">
            <option value="" <?php if($Produto->Categoria->nome == ""){ echo "selected"; } ?> ></option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection