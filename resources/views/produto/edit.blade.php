@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')


    <div class="box">
        <div class="box-header">
            <h2>Update Produto</h2>
        </div>
        <div class="box-body">
            <form role="form" method="post" action="/produto/edit" enctype="multipart/form-data">
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
            </form>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>




@endsection