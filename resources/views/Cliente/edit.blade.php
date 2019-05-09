@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')

    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/jquery.mask.js')}}"></script>
    <script src="{{asset('js/util.js')}}"></script>

    <div class="box">
        <div class="box-header">
            <h2>Update Cliente</h2>
        </div>
        <div class="box-dody">
            <form role="form" method="post" action="{{Request::root()}}/Cliente/edit-Cliente-post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" value="<?php echo $Cliente->id ?>"   name="Cliente_id">


                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" value="<?php echo $Cliente->nome ?>" class="form-control" id="nome" name="nome">
                </div>

                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" value="<?php echo $Cliente->cpf ?>" class="form-control" id="cpf" name="cpf">
                </div>

                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="text" value="<?php echo $Cliente->telefone ?>" class="form-control" id="telefone" name="telefone">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" value="<?php echo $Cliente->email ?>" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="endereco">Endereco:</label>
                    <input type="text" value="<?php echo $Cliente->endereco ?>" class="form-control" id="endereco" name="endereco">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection