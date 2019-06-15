@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')
    <div class="box box-solid box-primary">
        <div class="box-header">
            <h2>Numero da ordem de serviço: {{$OrdemServico->id}}</h2>
        </div>
        <div class="box-body">
            <ul class="list-group">
                <li class="list-group-item">Cliente: {{$cliente->nome}}</li>
                <li class="list-group-item">Telefone: {{$cliente->telefone}}</li>
                <li class="list-group-item">Email: {{$cliente->email}}</li>
                <li class="list-group-item">Endereço: {{\App\Helper\ObjectHelper::formatEndereco($cliente->endereco)}}</li>
                <li class="list-group-item">Emissor: {{$user->name}}</li>
                <li class="list-group-item">Data de abertura: {{date('d/m/Y',strtotime($OrdemServico->created_at))}}</li>
            </ul>


            <table class="table table-striped table-bordered" id="myTable">
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
                    <th id="total" class="money"></th>
                </tr>
                </tfoot>
            </table>
        </div>
        <div class="box-footer">
        </div>
    </div>

@endsection


@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
@stop

@section('js')
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/jquery.mask.js')}}"></script>
    <script src="{{asset('js/util.js')}}"></script>
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function ($) {
            $("#salvar").prop('disabled',true);
            var table = $('#myTable').DataTable();

            $('input.form-control.input-sm').on('keyup', function () {
                table.search(this.value).draw();
            });

            calcularTotal();

            function calcularTotal(){
                if(table.data().count() >= 1){
                    $('#total').text('R$' + mascaraValor
                    (
                        // calcular total de acordo com a coluna
                        parseFloat(
                            table
                                .column(2)
                                .data()
                                .reduce(function (a, b) {
                                    return parseFloat(a) + parseFloat(b);
                                })
                        ).toFixed(2)
                    )
                    );

                }else{
                    $('#total').text('R$' + mascaraValor("0,00"));
                }

            }

        });

    </script>
@stop