@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form role="form" method="post" action="{{ action('ClienteController@editPost')  }}" >
        <div class="box box-solid box-primary">
        <div class="box-header">
            <h2>Editar Cliente</h2>
        </div>
        <div class="box-body">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" value="<?php echo $cliente->id ?>"   name="Cliente_id">

                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" value="<?php echo $cliente->nome ?>" class="form-control" id="nome" name="nome">
                </div>

                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" value="<?php echo $cliente->cpf ?>" class="form-control" id="cpf" name="cpf">
                </div>

                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="text" value="<?php echo $cliente->telefone ?>" class="form-control" id="telefone" name="telefone">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" value="<?php echo $cliente->email ?>" class="form-control" id="email" name="email">
                </div>
            <div class="row">
                <div class="col-md-4 nopadding">
                    <div class="col-md-8">
                        <div class="form-group" style="margin-left: 0px">
                            <label for="cep">CEP:</label>
                            <input type="text" value="{{$cliente->endereco->cep}}" class="form-control" id="cep" name="cep">
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <button type="button" style="margin-top:25px" onclick="findEndereco()" class="btn btn-primary">Buscar</button>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cep">UF:</label>
                            <select type="text" class="form-control select2UF"  id="uf" name="uf">
                            </select>
                            <input type="hidden" id="selected" value="{{$cliente->endereco->uf}}">
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="cep">Localidade:</label>
                            <input type="text" value="{{$cliente->endereco->localidade}}" class="form-control" id="localidade" name="localidade">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cep">Bairro:</label>
                        <input type="text" value="{{$cliente->endereco->bairro}}" class="form-control" id="bairro" name="bairro">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cep">Logradouro:</label>
                        <input type="text" value="{{$cliente->endereco->logradouro}}" class="form-control" id="logradouro" name="logradouro">
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="cep">Complemento:</label>
                <input type="text" class="form-control" value="{{$cliente->endereco->complemento}}" id="complemento" name="complemento">
            </div>


        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    </form>
@endsection
@section('js')
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/jquery.mask.js')}}"></script>
    <script src="{{asset('js/select2.js')}}"></script>
    <script src="{{asset('js/util.js')}}"></script>
    <script>
        function findEndereco() {
            let cep = $('#cep').val();
            cep = cep.replaceAll(/\W/,'');
            $.getJSON(`https://viacep.com.br/ws/${cep}/json/`,function (endereco) {
                if (endereco.erro){
                    alert('CEP INVALIDO');
                    return true;
                }

                $('#logradouro').val(endereco.logradouro);
                $('#localidade').val(endereco.localidade);
                $('#bairro').val(endereco.bairro);
                $('#complemento').val(endereco.complemento);
                $('#uf').val(endereco.uf).change();
            });
        }

        $(document).ready(function () {
            $.getJSON(`https://servicodados.ibge.gov.br/api/v1/localidades/estados`, function (estados) {

                estados.map(function (estado) {

                    return estado.sigla == $('#selected').val() ?
                        $('#uf').append(`<option selected value="${estado.sigla}" id="${estado.sigla}">${estado.sigla}</option>`)
                        :$('#uf').append(`<option value="${estado.sigla}" id="${estado.sigla}">${estado.sigla}</option>`);
                });
            });
        });
    </script>
@endsection
