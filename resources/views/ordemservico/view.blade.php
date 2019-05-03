@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-xs-12 col-md-10 well">
                descricao  :  <?php echo $OrdemServico->descricao ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-10 well">
                cliente  :  <?php echo $OrdemServico->cliente ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-10 well">
                produto  :  <?php echo $OrdemServico->produto ?>
            </div>
        </div>

    </div>
@endsection
