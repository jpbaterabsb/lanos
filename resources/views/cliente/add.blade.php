@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('css')
    <style>
        .nopadding {
            padding: 0 !important;
            margin: 0 !important;
        }
    </style>
@endsection

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

    <form role="form" method="post" action="/cliente" >
    <div class="box box-solid box-primary">

        <div class="box-header">
            <h2>Adicionar Cliente</h2>
        </div>
        <div class="box-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome">
                </div>

                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" class="form-control cpf" id="cpf" name="cpf">
                </div>


            <div class="row">
                <div class="col-md-8 nopadding">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="telefone">Telefone:</label>
                            <input type="text" class="form-control" id="telefone" name="telefone">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="telefone">Tipo:</label>
                            <select name="tipo" id="tipo" class="form-control">
                                <option value="CELULAR" >CELULAR</option>
                                <option value="TELEFONE" selected>TELEFONE</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>


                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>

            <div class="row">
            <div class="col-md-4 nopadding">
                <div class="col-md-8">
                    <div class="form-group" style="margin-left: 0px">
                        <label for="cep">CEP:</label>
                        <input type="text" class="form-control" id="cep" name="cep">
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
                        <select type="text" class="form-control select2UF" id="uf" name="uf">
                        </select>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="cep">Localidade:</label>
                        <input type="text" class="form-control" id="localidade" name="localidade">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cep">Bairro:</label>
                    <input type="text" class="form-control" id="bairro" name="bairro">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cep">Logradouro:</label>
                    <input type="text" class="form-control" id="logradouro" name="logradouro">
                </div>
            </div>
        </div>


        <div class="form-group">
            <label for="cep">Complemento:</label>
            <input type="text" class="form-control" id="complemento" name="complemento">
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