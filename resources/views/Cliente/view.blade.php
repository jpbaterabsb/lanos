@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-10 well">
            nome  :  <?php echo $Cliente->nome ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-10 well">
            telefone  :  <?php echo $Cliente->telefone ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-10 well">
            email  :  <?php echo $Cliente->email ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-10 well">
            endereco  :  <?php echo $Cliente->endereco ?>
        </div>
    </div>
</div>
@endsection