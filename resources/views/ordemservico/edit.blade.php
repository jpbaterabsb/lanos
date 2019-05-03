@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')
    <h2>Update OrdemServico</h2>
    <form role="form" method="post" action="{{Request::root()}}/OrdemServico/edit-OrdemServico-post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" value="<?php echo $OrdemServico->id ?>"   name="OrdemServico_id">


        <div class="form-group">
            <label for="descricao">Descricao:</label>
            <input type="text" value="<?php echo $OrdemServico->descricao ?>" class="form-control" id="descricao" name="descricao">
        </div>
        <div class="form-group">
            <label for="cliente">Cliente:</label>
            <select class="form-control" id="cliente" name="cliente">
                <option value="" <?php if($OrdemServico->cliente == ""){ echo "selected"; } ?> ></option>
            </select>
        </div>
        <div class="form-group">
            <label for="produto">Produto:</label>
            <input type="text" value="<?php echo $OrdemServico->produto ?>" class="form-control" id="produto" name="produto">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection