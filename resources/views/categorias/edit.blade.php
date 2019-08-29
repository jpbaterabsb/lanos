@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')

<h2>Update Categorias</h2>
<form role="form" method="post" action="/categorias/edit    " enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" value="<?php echo $Categorias->id ?>"   name="Categorias_id">


    <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" value="<?php echo $Categorias->nome ?>" class="form-control" id="nome" name="nome">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection