@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-xs-12 col-md-10 well">
            descricao  :  <?php echo $Produto->descricao ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-10 well">
            quantidade  :  <?php echo $Produto->quantidade ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-10 well">
            valor  :  <?php echo $Produto->valor ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-10 well">
            Categoria  :  <?php echo $Produto->Categoria->nome ?>
        </div>
    </div>
</div>
@endsection
