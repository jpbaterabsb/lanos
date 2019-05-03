@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')

    <div class="container">

    <div class="row">
        <div class="col-xs-12 col-md-10 well">
            name  :  <?php echo $User->name ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-10 well">
            email  :  <?php echo $User->email ?>
        </div>
    </div>

    </div>
@endsection
