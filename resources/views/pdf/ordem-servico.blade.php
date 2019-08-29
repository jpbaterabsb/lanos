<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Título Opcional</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--Custon CSS (está em /public/assets/site/css/certificate.css)-->
    {{--<link rel="stylesheet" href="{{ url('assets/site/css/certificate.css') }}">--}}
    <style>
        .cssTable td,th,tfoot
        {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <h3 >Numero da ordem de serviço: {{$ordemServico->id}}</h3>
    </div>
</div>
        <table id="table" class="table-striped table-bordered cssTable" style="width: 100%">

            <tbody>
            <tr>
                <td colspan="4"><center>
                        <h4>
                            Lano's Informatica
                        </h4>
                    </center></td>
            </tr>
            <tr>
                <td>
                    Nome:
                </td>
                <td>
                    {{$cliente->nome}}
                </td>
                <td>
                    CPF:
                </td>
                <td>
                    {{$cliente->cpf}}
                </td>
            </tr>
            <tr>
                <td>
                    Telefone:
                </td>
                <td>
                    {{$cliente->telefone}}
                </td>
                <td>
                    Email:
                </td>
                <td>
                    {{$cliente->email}}
                </td>
            </tr>
            <tr>
                <td>
                    Endereço:
                </td>
                <td colspan="3">
                    {{\App\Helper\ObjectHelper::formatEndereco($cliente->endereco)}}
                </td>
            </tr>
            <tr>
                <td>
                    Emissor:
                </td>
                <td>
                    {{$user->name}}
                </td>
                <td>
                    data de emissão:
                </td>
                <td>
                    {{date('d/m/Y',strtotime($ordemServico->created_at))}}
                </td>
            </tr>
            </tbody>
        </table>
    </div>

<br><br><br>
<table class="table-striped table-bordered cssTable" style="width: 100%" id="myTable">
    <thead class="">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Produto</th>
        <th scope="col">Valor</th>
    </tr>
    </thead>

    <tbody>
    @foreach($produtos as $produto)
        <tr>
            <td>{{$produto->id}}</td>
            <td>{{$produto->descricao}}</td>
            <td>{{$produto->pivot->valor_venda}}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th colspan="2" style="text-align:right">Total:</th>
        <th id="total" class="money">{{\App\Helper\ObjectHelper::getTotalArrayMoneyFormat($produtos)}}</th>
    </tr>
    </tfoot>
</table>

<div class="form-group">
    <label for="descricao">Descricao:</label>
    <p  id="descricao" name="descricao">{{$ordemServico->descricao}}</p>
</div>


<table style="width: 100%">
    <tr>
        <td>____________________________</td>
        <td>____________________________</td>
    </tr>
    <tr>
        <td>Cliente</td>
        <td>Responsável Loja</td>
    </tr>
</table>

{{--<ul class="">--}}
{{--<li class="">cliente: {{$cliente->nome}}</li>--}}
{{--<li class="">Telefone: {{$cliente->telefone}}</li>--}}
{{--<li class="">Email: {{$cliente->email}}</li>--}}
{{--<li class="">Endereço: {{$cliente->endereco}}</li>--}}
{{--<li class="">Emissor: {{$user->name}}</li>--}}
{{--<li class="">Data de abertura: {{date('d/m/Y',strtotime($ordemServico->created_at))}}</li>--}}
{{--</ul>--}}


</body>
</html>